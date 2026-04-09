<?php

namespace App\Decorators;

use App\Constants\Statuses;
use App\Contracts\OrdersContract;
use App\Entities\{Cancelled, Cart, Detail, Order, Payment};
use App\Http\Requests\RequestOrderStore;
use App\Jobs\ActualStockProduct;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DecoratorOrder implements OrdersContract
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('jam.place_to_pay.url_base'),
            'timeout'  => 10,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {

            $cart = Cart::findOrFail($request->get('cart_id'));

            if (!$cart->valueCart()) {
                return redirect('vitrina')->with('success', 'Continue con su compra');
            }

            $order = $this->createOrderFromCart($cart);

            $response = $this->createSession($order);

            $this->createPayment($order, $response);

            logger()->info('P2P create session', ['response' => $response]);

            return redirect()->away($response->processUrl);
        });
    }

    public function update(Request $request, int $id): Order
    {
        $order = Order::with('payment')->findOrFail($id);

        if (!$order->payment) {
            return $order;
        }

        $response = $this->getSession($order);

        $this->updatePaymentStatus($order, $response);

        logger()->info('P2P update status', ['response' => $response]);

        return $order->refresh();
    }

    public function resend(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->get('order'));

        $response = $this->createSession($order);

        $order->payment->update([
            'processUrl' => $response->processUrl,
            'requestId' => $response->requestId,
            'status' => Statuses::PENDING,
        ]);

        return redirect()->away($response->processUrl);
    }

    public function reversePay(Request $request): void
    {
        DB::transaction(function () use ($request) {

            $order = Order::with(['payment', 'user'])->findOrFail($request->get('order'));

            $response = $this->reverseSession($order);

            Cancelled::create([
                'user_id' => $order->user->id,
                'status' => Statuses::CANCELED,
                'statusTransaction' => $response->status->status,
                'requestId' => $order->payment->requestId,
                'internalReference' => $order->payment->internalReference,
                'processUrl' => $order->payment->processUrl,
                'message' => $response->status->message,
                'document' => $order->payment->document,
                'name' => $order->payment->name,
                'email' => $order->payment->email,
                'mobile' => $order->payment->mobile,
                'locale' => $order->payment->locale,
                'amountReturn' => data_get($response, 'payment.amount.from.total'),
                'order_id' => $order->id,
                'cancelled_by' => auth()->id(),
                'totalOrder' => $order->total,
            ]);

            $order->delete();
        });
    }

    public function complete(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->get('order'));

        $this->getSession($order);

        return redirect()->away($order->payment->processUrl);
    }

    public function paymentInStore(RequestOrderStore $request)
    {
        return DB::transaction(function () use ($request) {

            $cart = Cart::findOrFail($request->get('cart_id'));

            if ($cart->valueCart() === 0) {
                return redirect('vitrina')->with('success', 'Continue con su compra');
            }

            $order = $this->createOrderFromCart($cart, Statuses::APPROVED_IN_STORE);

            $user = auth()->user();

            Payment::create([
                'order_id' => $order->id,
                'status' => Statuses::APPROVED_IN_STORE,
                'base' => 'tienda',
                'message' => "pago en tienda por {$user->name} ({$user->id})",
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
            'processUrl' => $response->processUrl,
            'requestId' => $response->requestId,
            'status' => Statuses::PENDING,
        ]);
    }

    private function createSession(Order $order): object
    {
        return $this->request('/api/session', [
            'auth' => $this->auth(),
            'payment' => [
                'reference' => $order->id,
                'description' => "Orden #{$order->id}",
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total,
                ],
                'allowPartial' => false,
            ],
            'expiration' => now()->addDays(2)->toIso8601String(),
            'returnUrl' => route('orders.show', [
                'user' => auth()->id(),
                'order' => $order->id,
            ]),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->userAgent(),
        ]);
    }

    private function getSession(Order $order): object
    {
        return $this->request("/api/session/{$order->payment->requestId}", [
            'auth' => $this->auth(),
        ]);
    }

    private function reverseSession(Order $order): object
    {
        return $this->request('/api/reverse', [
            'auth' => $this->auth(),
            'internalReference' => $order->payment->internalReference,
        ]);
    }

    private function request(string $uri, array $data): object
    {
        $response = $this->client->post($uri, ['json' => $data]);

        return json_decode($response->getBody()->getContents());
    }

    private function updatePaymentStatus(Order $order, object $response): void
    {
        $status = $response->status->status;

        $payload = [
            'status' => $status,
            'message' => $response->status->message ?? null,
        ];

        if ($status === Statuses::APPROVED) {
            $payment = collect($response->payment)->first();

            $payload += [
                'internalReference' => $payment->internalReference,
                'amount' => data_get($payment, 'amount.from.total'),
                'document' => data_get($response, 'request.payer.document'),
                'name' => data_get($response, 'request.payer.name'),
                'email' => data_get($response, 'request.payer.email'),
                'mobile' => data_get($response, 'request.payer.mobile'),
                'locale' => data_get($response, 'request.locale'),
            ];
        }

        $order->payment->update($payload);
    }

    private function auth(): array
    {
        $seed = now()->toIso8601String();
        $nonce = bin2hex(random_bytes(16));

        return [
            'login' => config('jam.place_to_pay.login'),
            'seed' => $seed,
            'nonce' => base64_encode($nonce),
            'tranKey' => base64_encode(sha1($nonce . $seed . config('jam.place_to_pay.secret_key'), true)),
        ];
    }
}
