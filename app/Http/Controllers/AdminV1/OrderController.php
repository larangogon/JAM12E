<?php

namespace App\Http\Controllers\AdminV1;

use App\Constants\Statuses;
use App\Contracts\OrdersContract;
use App\Entities\Cancelled;
use App\Entities\Order;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestOrderStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $orders;

    public function __construct(OrdersContract $orders, Order $order)
    {
        $this->order = $order;
        $this->orders = $orders;
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
    }

    public function index(Request $request): View
    {
        $this->authorize('order.index');

        $search = $request->get('search', null);

        $this->order = new Order();

        return view('orders.index', [
            'search' => $search,
            'orders' => $this->order
                ->search($search)
                ->paginate(15),
        ]);
    }

    public function create(Request $request): View
    {
        return view('orders.create', [
            'cart' => Auth::user()->cart,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->orders->store($request);
    }

    public function update(Request $request, int $id)
    {
        $this->orders->update($request, $id);
    }

    public function show(Request $request, Order $order): View
    {
        $this->authorize('owner', $order);

        $order = $this->orders->update($request, $order->id);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function showv(User $user): View
    {
        $this->authorize('ownerIndex', [
            Order::class, $user->id,
        ]);

        return view('orders.showv', [
            'orders' => $user->orders,
        ]);
    }

    public function shippingStatus(Order $order): RedirectResponse
    {
        $state = $order->shippingStatus;

        $order->shippingStatus = !$state;

        $order->update();

        return redirect('/orders');
    }

    public function resend(Request $request)
    {
        $this->orders->resend($request);
    }

    public function reversePayment(Request $request): RedirectResponse
    {
        $this->orders->reversePayment($request);

        return redirect('cancelled-orders')
            ->with('success', 'Payment has been successfully reversed!');
    }

    public function complete(Request $request): RedirectResponse
    {
        return $this->orders->complete($request);
    }

    public function cancelled(Request $request): View
    {
        $search = $request->get('search', null);

        $this->cancelled = new Cancelled();

        return view('orders.cancelled', [
            'search' => $search,
            'cancelledOrders' => $this->cancelled
                ->search($search)
                ->paginate(5),
        ]);
    }

    public function paymentInStore(RequestOrderStore $request): RedirectResponse
    {
        $this->orders->paymentInStore($request);

        return redirect('orders')->with('success', 'Order created successfully');
    }

    public function cancelStoreOrder(Request $request): RedirectResponse
    {
        $order = Order::find($request->get('order'));

        Cancelled::create([
            'user_id' => $order->user->id,
            'statusTransaction' => Statuses::APPROVED_IN_STORE,
            'message' => $order->payment->message,
            'document' => $order->payment->document,
            'name' => $order->payment->name,
            'email' => $order->payment->email,
            'mobile' => $order->payment->mobile,
            'amountReturn' => $order->payment->totalStore,
            'order_id' => $order->id,
            'description' => 'Garantia',
            'cancelled_by' => auth()->user()->id,
            'totalOrder' => $order->total,
            'status' => Statuses::CANCELED,
        ]);

        Order::destroy($request->get('order'));

        return Redirect()->back()
            ->with('success', 'Deleted successfully!');
    }
}
