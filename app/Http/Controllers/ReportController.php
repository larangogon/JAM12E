<?php

namespace App\Http\Controllers;

use App\Order;

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
        $pdf = \PDF::loadView('reports.reportOrders');
        return $pdf->download('orderpdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportProducts()
    {
        $pdf = \PDF::loadView('reports.reportProducts');
        return $pdf->download('productspdf.pdf');
    }

}
