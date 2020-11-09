<?php

namespace App\Http\Controllers;

use App\Entities\Cancelled;
use App\Entities\User;
use App\Entities\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceOrders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    protected $orders;

    /**
     * OrderController constructor.
     * @param InterfaceOrders $orders
     * @param Order $order
     */
    public function __construct(InterfaceOrders $orders, Order $order)
    {
        $this->order = $order;
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
        $search   = $request->get('search', null);

        $this->order = new Order();

        return view('orders.index', [
            'search' => $search,
            'orders' => $this->order
                ->search($search)
                ->paginate(5)
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
     * @param int $id
     * @return RedirectResponse
     */
    public function shippingStatus(int $id): RedirectResponse
    {
        $orders = Order::findOrFail($id);

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
        $this->orders->reversePay($request);

        return redirect('vitrina')
            ->with('success', ' el pago se  ha revertido exitosamente!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function complete(Request $request): RedirectResponse
    {
        return $this->orders->complete($request);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function canceller(Request $request): View
    {
        $search = $request->get('search', null);

        $this->canceller = new Cancelled();

        return view('orders.canceller', [
            'search'     => $search,
            'cancellers' => $this->canceller
                ->search($search)
                ->paginate(5)
        ]);
    }
}
