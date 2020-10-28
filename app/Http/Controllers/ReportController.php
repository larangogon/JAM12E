<?php

namespace App\Http\Controllers;

use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Shipping;
use App\Entities\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Order::find($id);
        $pdf = \PDF::loadView('reports.show', compact('factura'));
        return $pdf->download('factura.pdf');
    }

    /**
     * @return mixed
     */
    public function reportOrders()
    {
        $order = Order::where('created_at', '>=', now()->subDays(30))->get();
        $pdf = \PDF::loadView('orders.index', compact('order'));
        return $pdf->download('orderpdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportPayments()
    {
        $payment = Payment::where('created_at', '>=', now()->subDays(30))->get();
        $pdf = \PDF::loadView('reports.reportPayments', compact('payment'));
        return $pdf->download('paymentpdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportShippings()
    {
        $order = Order::all();
        $shipping = Shipping::where('created_at', '>=', now()->subDays(30))->get();
        $pdf = \PDF::loadView('reports.reportShippings',[
            'shipping' => $shipping,
            'order' => $order
        ]);
        return $pdf->download('shippingpdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportProducts()
    {
        $product = Product::where('created_at', '>=', now()->subMonths(6))->get();
        $pdf = \PDF::loadView('reports.reportProducts', compact('product'));
        return $pdf->download('productspdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportUsers()
    {
        $user = User::where('created_at', '>=', now()->subMonths(6))->get();
        $pdf = \PDF::loadView('reports.reportUsers', compact('user'));
        return $pdf->download('userspdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportAnual()
    {
        $user = User::all();
        $product = Product::all();
        $order = Order::all();

        $payment = Payment::where('created_at', '>=', now()->subYears(1))->get();
        $pdf = \PDF::loadView('reports.reportAnual',[
            'payment' => $payment,
            'product' => $product,
            'user'    => $user,
            'order'    => $order
        ]);
        return $pdf->download('anualpdf.pdf');
    }
}
