<?php

namespace App\Decorators;

use App\Entities\Cancelled;
use App\Entities\Cart;
use App\Entities\Order;
use App\Entities\Detail;
use App\Entities\Payment;
use App\Http\Requests\RequestOrderStore;
use App\Jobs\ActualStockProduct;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Constants\PlaceToPay;
use App\Repositories\OrdersRepo;
use App\Interfaces\InterfaceOrders;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DecoratorOrder implements InterfaceOrders
{
    protected $ordersRepo;

    /**
     * DecoratorOrder constructor.
     * @param OrdersRepo $ordersRepo
     */
    public function __construct(OrdersRepo $ordersRepo)
    {
        $this->ordersRepo = $ordersRepo;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $this->ordersRepo->store($request);

        $cart = Cart::find($request->get('cart_id'));

        if (!$cart->totalCarrito()) {
            return redirect('vitrina')->with('success', 'Continue con su compra');
        }

        $order = Order::create([
            'user_id' => $cart->user_id,
            'total'   => $cart->totalCarrito(),
            'status'  => 'PENDING'
        ]);

        foreach ($cart->products as $product) {
            $detail = Detail::create([
                'order_id'    => $order->id,
                'product_id'  => $product->id,
                'size_id'     => $product->pivot->size_id,
                'category_id' => $product->pivot->category_id,
                'color_id'    => $product->pivot->color_id,
                'stock'       => $product->pivot->stock,
                'total'       => $product->price * $product->pivot->stock,
            ]);
        }

        $cart->products()->detach();

        $response = $this->requestP2P('create', $order);
        $processUrl = $response->processUrl;
        $requestId  = $response->requestId;

        Payment::create([
            'order_id'   => $order->id,
            'processUrl' => $processUrl,
            'requestId'  => $requestId,
            'status'     => PlaceToPay::PENDING,
            ]);

        return redirect()->away($processUrl)->send();
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function update(Request $request, int $id)
    {
        $this->ordersRepo->update($request, $id);

        $order = Order::find($id);

        if (!$order->payment) {
            $order = Order::find($id);
        } elseif ($order->payment->status === PlaceToPay::PENDING) {
            $response = $this->requestP2P('getRequestinformation', $order);

            $status = $response->status->status;


            $order->payment->update([
                'status' => $status
            ]);
        } elseif ($order->payment->status === PlaceToPay::APPROVED) {
            $response = $this->requestP2P('getRequestinformation', $order);

            foreach ($response->payment as $payments) {
                $pay = $payments;
            }

            $status            = $response->status->status;
            $amount            = $pay->amount->from->total;
            $internalReference = $pay->internalReference;
            $message           = $response->status->message;
            $payerdocument     = $response->request->payer->document;
            $payername         = $response->request->payer->name;
            $payeremail        = $response->request->payer->email;
            $payermobile       = $response->request->payer->mobile;
            $locale            = $response->request->locale;

            $order->payment->update([
                'internalReference' => $internalReference,
                'status'            => $status,
                "message"           => $message,
                'amount'            => $amount,
                'document'          => $payerdocument,
                'name'              => $payername,
                'email'             => $payeremail,
                'mobile'            => $payermobile,
                'locale'            => $locale
            ]);
        } elseif ($order->payment->status === PlaceToPay::REJECTED) {
            $response = $this->requestP2P('getRequestinformation', $order);

            $status  = $response->status->status;
            $message = $response->status->message;

            $order->payment->update([
                'status'  => $status,
                "message" => $message
            ]);
        }

        return $order;
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function authP2P(): array
    {
        $secretKey = config('app.secretKey');
        $login     = config('app.login');

        $seed = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        return [
            'login'   => $login,
            'seed'    => $seed,
            'nonce'   => $nonceBase64,
            'tranKey' => $tranKey
            ];
    }

    /**
     * @param $requestType
     * @param $order
     * @return mixed
     * @throws \Exception
     */
    public function requestP2P($requestType, $order)
    {
        $client = new Client();

        if ($requestType === 'create') {
            $request = [
                'auth' => $this->authP2P(),
                'payment' => [
                    "reference"   => $order->id,
                    "description" => "Pago realizado con numero de orden_" . $order->id,
                    "amount"      => [
                        "currency" => "COP",
                        "total"    => $order->total,
                    ],

                    "allowPartial" => false,
                ],

                "expiration" => date('c', strtotime('+2 days')),
                "returnUrl"  => route('orders.show', [
                    'user'   => auth()->id(),
                    'order'  => $order->id
                ]),
                "ipAddress" => request()->getClientIp(),
                "userAgent" => request()->userAgent()
            ];

            $res = $client->post(
                'https://test.placetopay.com/redirection/api/session',
                ['json' => $request]
            );

            return json_decode($res->getBody()->getContents());
        } elseif ($requestType === 'getRequestinformation') {
            $requestId = $order->payment->requestId;

            $request = [
                'auth' => $this->authP2P()
            ];
            $res = $client->post(
                'https://test.placetopay.com/redirection/api/session/' . $requestId,
                ['json' => $request]
            );

            return json_decode($res->getBody()->getContents());
        } elseif ($requestType === 'reverse') {
            $request = [
                'auth' => $this->authP2P(),

                "internalReference"  => $order->payment->internalReference,
            ];

            $res = $client->post(
                'https://test.placetopay.com/redirection/api/reverse',
                ['json' => $request]
            );
            return json_decode($res->getBody()->getContents());
        } elseif ($requestType === 'complete') {
            $requestId = $order->payment->requestId;

            $request = [
                'auth' => $this->authP2P()
            ];
            $res = $client->post(
                'https://test.placetopay.com/redirection/api/session/' . $requestId,
                ['json' => $request]
            );
            return json_decode($res->getBody()->getContents());
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function resend(Request $request): RedirectResponse
    {
        $order = Order::find($request->get('order'));

        $response = $this->requestP2P('create', $order);

        $processUrl = $response->processUrl;
        $requestId  = $response->requestId;

        $order->payment->update([
            'processUrl' => $processUrl,
            'requestId'  => $requestId,
            'status'     => PlaceToPay::PENDING,
        ]);

        return redirect()->away($processUrl)->send();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function reversePay(Request $request)
    {
        $order = Order::find($request->get('order'));

        $response = $this->requestP2P('reverse', $order);

        $orderCancelled = Cancelled::create([
        'user_id'           => $order->user->id,
        'status'            => 'CANCELADO',
        'statusTransaction' => $response->status->status,
        'requestId'         => $order->payment->requestId,
        'internalReference' => $order->payment->internalReference,
        'processUrl'        => $order->payment->processUrl,
        'message'           => $response->status->message,
        'document'          => $order->payment->document,
        'name'              => $order->payment->name,
        'email'             => $order->payment->email,
        'mobile'            => $order->payment->mobile,
        'locale'            => $order->payment->locale,
        'amountReturn'      => $response->payment->amount->from->total,
        'order_id'          => $order->id,
        'cancelled_by'      => auth()->user()->id,
        'totalOrder'        => $order->total,
        ]);

        Order::destroy($request->get('order'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function complete(Request $request): RedirectResponse
    {
        $order = Order::find($request->get('order'));

        $response = $this->requestP2P('complete', $order);

        $processUrl = $order->payment->processUrl;
        $requestId  = $order->payment->requestId;

        $order->payment->update([
            'processUrl' => $processUrl,
            'requestId'  => $requestId,
            'status'     => PlaceToPay::PENDING,
        ]);

        return redirect()->away($processUrl)->send();
    }

    /**
     * @param RequestOrderStore $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function paymentInStore(RequestOrderStore $request)
    {
        $this->ordersRepo->paymentInStore($request);

        $cart = Cart::find($request->get('cart_id'));

        if ($cart->totalCarrito() === 0) {
            return redirect('vitrina')->with('success', 'Continue con su compra');
        }

        $order = Order::create([
            'user_id' => $cart->user_id,
            'total'   => $cart->totalCarrito(),
            'status'  => 'APROVADO_T',
        ]);

        foreach ($cart->products as $product) {
            $detail = Detail::create([
                'order_id'    => $order->id,
                'product_id'  => $product->id,
                'size_id'     => $product->pivot->size_id,
                'category_id' => $product->pivot->category_id,
                'color_id'    => $product->pivot->color_id,
                'stock'       => $product->pivot->stock,
                'total'       => $product->price * $product->pivot->stock,
            ]);
        }

        $cart->products()->detach(null);

        Payment::create([
            'order_id'   => $order->id,
            'status'     => 'APROVADO_T',
            'base'       => 'tienda',
            'message'    => 'pago generado en la tienda por el admin' . auth()->user()->id,
            'document'   => $request->get('document'),
            'name'       => $request->get('name'),
            'email'      => $request->get('email'),
            'mobile'     => $request->get('mobile'),
            'amount'     => $order->total,
            'totalStore' => $request->get('totalStore'),
            'expiration' => now()->addDays(30)->toDateString()
        ]);

        dispatch(new ActualStockProduct($order));
    }
}
