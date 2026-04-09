<?php

namespace App\Decorators;

use App\Constants\Statuses;
use App\Contracts\OrdersContract;
use App\Entities\Cancelled;
use App\Entities\Cart;
use App\Entities\Detail;
use App\Entities\Order;
use App\Entities\Payment;
use App\Http\Requests\RequestOrderStore;
use App\Jobs\ActualStockProduct;
use App\Services\PaymentTransactionService;
use App\Services\PlaceToPayService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DecoratorOrder implements OrdersContract
{
    private PlaceToPayService $placeToPayService;
    private PaymentTransactionService $transactionService;

    public function __construct(
        PlaceToPayService $placeToPayService,
        PaymentTransactionService $transactionService
    ) {
        $this->placeToPayService = $placeToPayService;
        $this->transactionService = $transactionService;
    }

    public function store(Request $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            $cart = Cart::findOrFail($request->get('cart_id'));

            if (!$cart->valueCart()) {
                return redirect('storefront')->with('success', 'Continue with your purchase');
            }

            $order = $this->createOrderFromCart($cart);

            try {
                $user = auth()->user();
                $response = $this->placeToPayService->createSession(
                    payment: [
                        'reference' => (string)$order->id,
                        'description' => "Order #{$order->id}",
                        'amount' => [
                            'currency' => 'COP',
                            'total' => $order->total,
                        ],
                    ],
                    payer: [
                        'name' => $user->name,
                        'email' => $user->email,
                        'document' => $user->document ?? '',
                        'mobile' => $user->cellphone ?? '',
                    ],
                    returnUrl: route('orders.show', ['order' => $order->id]),
                    cancelUrl: route('orders.index'),
                );

                $this->createPayment($order, $response);

                Log::info('PlaceToPay session created successfully', [
                    'order_id' => $order->id,
                    'request_id' => $response->requestId ?? null,
                ]);

                return redirect()->away($response->processUrl);
            } catch (Exception $e) {
                Log::error('Failed to create PlaceToPay session', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);

                $order->delete();
                return redirect()->back()->with('error', 'Could not process payment. Try again.');
            }
        });
    }

    public function update(Request $request, int $id): Order
    {
        $order = Order::with('payment')->findOrFail($id);

        if (!$order->payment) {
            return $order;
        }

        try {
            $response = $this->placeToPayService->getSession($order->payment->requestId);
            $newStatus = $response->status->status;

            $this->transactionService->updatePaymentStatus(
                $order->payment,
                $newStatus,
                'UPDATE',
                $this->extractPaymentData($response),
                [
                    'request_id' => $order->payment->requestId,
                    'placetopay_status' => $newStatus,
                    'response' => $response,
                    'initiated_by' => 'update_check',
                ]
            );

            Log::info('PlaceToPay session status updated', [
                'order_id' => $order->id,
                'request_id' => $order->payment->requestId,
                'status' => $newStatus,
            ]);

            return $order->refresh();
        } catch (Exception $e) {
            Log::error('Failed to update PlaceToPay session status', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return $order;
        }
    }

    public function resend(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->get('order'));

        try {
            $response = $this->placeToPayService->createSession(
                payment: [
                    'reference' => (string)$order->id,
                    'description' => "Order #{$order->id} (Resend)",
                    'amount' => [
                        'currency' => 'COP',
                        'total' => $order->total,
                    ],
                ],
                payer: [
                    'name' => $order->user->name,
                    'email' => $order->user->email,
                    'document' => $order->user->document ?? '',
                    'mobile' => $order->user->cellphone ?? '',
                ],
                returnUrl: route('orders.show', ['order' => $order->id]),
                cancelUrl: route('orders.index'),
            );

            $order->payment->update([
                'processUrl' => $response->processUrl,
                'requestId' => $response->requestId,
                'status' => Statuses::PENDING,
            ]);

            Log::info('PlaceToPay session resent', ['order_id' => $order->id]);

            return redirect()->away($response->processUrl);
        } catch (Exception $e) {
            Log::error('Failed to resend PlaceToPay session', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Could not resend payment link.');
        }
    }

    public function reversePayment(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $order = Order::with(['payment', 'user'])->findOrFail($request->get('order'));

            try {
                $this->transactionService->updatePaymentStatus(
                    $order->payment,
                    Statuses::REVERSE_PENDING,
                    'REVERSE',
                    [],
                    ['initiated_by' => 'user']
                );

                $response = $this->placeToPayService->reverse($order->payment->internalReference);

                $this->transactionService->updatePaymentStatus(
                    $order->payment,
                    Statuses::REVERSED,
                    'REVERSE',
                    [],
                    [
                        'placetopay_status' => $response->status->status ?? 'OK',
                        'response' => $response,
                        'initiated_by' => 'reverse_success',
                    ]
                );

                Cancelled::create([
                    'user_id' => $order->user->id,
                    'status' => Statuses::REVERSED,
                    'statusTransaction' => $response->status->status ?? 'OK',
                    'requestId' => $order->payment->requestId,
                    'internalReference' => $order->payment->internalReference,
                    'processUrl' => $order->payment->processUrl,
                    'message' => $response->status->message ?? 'Reverse processed successfully',
                    'document' => $order->payment->document,
                    'name' => $order->payment->name,
                    'email' => $order->payment->email,
                    'mobile' => $order->payment->mobile,
                    'locale' => $order->payment->locale,
                    'amountReturn' => data_get($response, 'payment.0.amount.from.total', $order->payment->amount),
                    'order_id' => $order->id,
                    'cancelled_by' => auth()->id(),
                    'totalOrder' => $order->total,
                ]);

                Log::info('Payment reversed successfully', [
                    'order_id' => $order->id,
                    'payment_id' => $order->payment->id,
                    'status_before' => $order->payment->status,
                    'status_after' => Statuses::REVERSED,
                ]);

                $order->delete();
            } catch (Exception $e) {
                $this->transactionService->updatePaymentStatus(
                    $order->payment,
                    Statuses::REVERSE_FAILED,
                    'REVERSE',
                    [],
                    [
                        'error' => $e->getMessage(),
                        'error_details' => $e->getTraceAsString(),
                        'success' => false,
                        'initiated_by' => 'reverse_failed',
                    ]
                );

                Log::error('Failed to reverse payment', [
                    'order_id' => $order->id,
                    'payment_id' => $order->payment->id,
                    'error' => $e->getMessage(),
                ]);

                throw $e;
            }
        });
    }

    public function complete(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->get('order'));

        try {
            $this->placeToPayService->getSession($order->payment->requestId);
        } catch (Exception $e) {
            Log::error('Failed to verify session on complete', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->away($order->payment->processUrl);
    }

    public function paymentInStore(RequestOrderStore $request)
    {
        return DB::transaction(function () use ($request) {
            $cart = Cart::findOrFail($request->get('cart_id'));

            if ($cart->valueCart() === 0) {
                return redirect('storefront')->with('success', 'Continue with your purchase');
            }

            $order = $this->createOrderFromCart($cart, Statuses::APPROVED_IN_STORE);

            $user = auth()->user();

            Payment::create([
                'order_id' => $order->id,
                'status' => Statuses::APPROVED_IN_STORE,
                'base' => 'store',
                'message' => "In-store payment by {$user->name} ({$user->id})",
                'document' => $request->get('document'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
                'amount' => $order->total,
                'totalStore' => $request->get('totalStore'),
                'expiration' => now()->addDays(30),
            ]);

            dispatch(new ActualStockProduct($order));

            return $order;
        });
    }

    private function createOrderFromCart(Cart $cart, string $status = Statuses::PENDING): Order
    {
        $order = Order::create([
            'user_id' => $cart->user_id,
            'total' => $cart->valueCart(),
            'status' => $status,
        ]);

        foreach ($cart->products as $product) {
            Detail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'size_id' => $product->pivot->size_id,
                'category_id' => $product->pivot->category_id,
                'color_id' => $product->pivot->color_id,
                'stock' => $product->pivot->stock,
                'total' => $product->price * $product->pivot->stock,
            ]);
        }

        $cart->products()->detach();

        return $order;
    }

    private function createPayment(Order $order, object $response): void
    {
        Payment::create([
            'order_id' => $order->id,
            'processUrl' => $response->processUrl ?? '',
            'requestId' => $response->requestId ?? '',
            'status' => Statuses::PENDING,
        ]);
    }

    private function extractPaymentData(object $response): array
    {
        $data = [];

        if (isset($response->payment) && !empty($response->payment)) {
            $payment = collect($response->payment)->first();

            if ($payment) {
                $data = [
                    'internalReference' => $payment->internalReference ?? '',
                    'amount' => data_get($payment, 'amount.from.total', 0),
                    'document' => data_get($response, 'request.payer.document', ''),
                    'name' => data_get($response, 'request.payer.name', ''),
                    'email' => data_get($response, 'request.payer.email', ''),
                    'mobile' => data_get($response, 'request.payer.mobile', ''),
                    'locale' => data_get($response, 'request.locale', 'es_CO'),
                ];
            }
        }

        return $data;
    }
}
