<?php

namespace App\Http\Controllers;

use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
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
    public function reportOrders(Request $request)
    {
        $search   = $request->get('search', null);
        $orders = Order::all();
        $pdf = \PDF::loadView('reports.orders',['orders' => $orders, 'search' => $search]);
        return $pdf->download('orderpdf.pdf');
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
