<?php

namespace App\Http\Controllers;

use App\Shipping;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Constants\PaceToPay;
use App\Interfaces\InterfaceOrders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    protected $orders;

    /**
     * OrderController constructor.
     * @param InterfaceOrders $orders
     */
    public function __construct(InterfaceOrders $orders)
    {
        $this->orders = $orders;
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query  = trim($request->get('search'));

        $orders = Order::where('id', 'LIKE', '%' . $query . '%')
                        ->orWhere('status', 'LIKE', '%' . $query . '%')
                        ->orWhere('shippingStatus', 'LIKE', '%' . $query . '%')
                        ->orderBy('id', 'asc')
                        ->paginate(6);

        return view('orders.index', [
            'orders' => $orders,
            'search' => $query
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('orders.create', [
            'cart' => Auth::user()->cart
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return $this->orders->store($request);
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $this->orders->update($request, $id);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Order $order): View
    {
        $this->authorize('owner', $order);

        $order = $this->orders->update($request, $order->id);

        return view('orders.show', [
            'order' => $order
        ]);
    }

    /**
     * @param User $user
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showv(User $user): View
    {
        $this->authorize('ownerIndex', [
            Order::class, $user->id
        ]);

        return view('orders.showv', [
            'orders' => $user->orders
        ]);
    }

    /**
     * @param int $order_id
     * @return RedirectResponse
     */
    public function shippingStatus(int $order_id):RedirectResponse
    {
        $orders = Order::findOrFail($order_id);

        $state = $orders->shippingStatus;

        $orders->shippingStatus = !$state;

        $orders->update();

        return redirect('/orders');
    }

    /**
     * @param Request $request
     */
    public function resend(Request $request)
    {
        $this->orders->resend($request);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function reversePay(Request $request): RedirectResponse
    {
        $order = $this->orders->reversePay($request);

        Session::flash('message', ' el pago se  ha revertido exitosamente!');

        return redirect('vitrina');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function complete(Request $request): RedirectResponse
    {
        return $this->orders->complete($request);
    }
}
