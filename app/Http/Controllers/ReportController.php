<?php

namespace App\Http\Controllers;

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
