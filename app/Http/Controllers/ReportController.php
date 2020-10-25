<?php

namespace App\Http\Controllers;

use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Shipping;
use App\Entities\User;

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
        $pdf = \PDF::loadView('reports.reportOrders', compact('order'));
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
        $shipping = Shipping::where('created_at', '>=', now()->subDays(30))->get();
        $pdf = \PDF::loadView('reports.reportShippings', compact('shipping'));
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
        $payment = Payment::where('created_at', '>=', now()->subYears(1))->get();
        $pdf = \PDF::loadView('reports.reportAnual',[
            'payment' => $payment,
            'product' => $product,
            'user'    => $user
        ]);
        return $pdf->download('anualpdf.pdf');
    }
}
