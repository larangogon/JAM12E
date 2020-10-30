<?php

namespace App\Http\Controllers;

use App\Entities\Cancelled;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Report;
use App\Entities\User;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
        $this->middleware('role:Administrator');
    }

    /**
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
        $now = new \DateTime();

        $visit = Product::orderBy('visits', 'desc')
            ->take(4)->get(['name', 'id', 'visits']);

        $sales = Product::orderBy('sales', 'desc')
            ->take(4)->get(['name', 'id', 'sales']);

        $hoy = Order::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
        $pay = Payment::whereDate('updated_at', '=', now()->format('Y-m-d'))->count();
        $products = Product::whereDate('created_at', '>=', now()
            ->subYears(1)
            ->format('Y-m-d'))
            ->count();

        $users = User::whereDate('created_at', '>=', now()
            ->subYears(1000)
            ->format('Y-m-d'))
            ->count();

        $payments = Payment::whereDate('updated_at', '>=', now()
            ->subYears(1000)
            ->format('Y-m-d'))
            ->count();

        $cancelled = Cancelled::whereDate('updated_at', '>=', now()
            ->subYears(1000)
            ->format('Y-m-d'))
            ->count();

        $pdf = \PDF::loadView('reports.orders',[
            'hoy'       => $hoy,
            'pay'       => $pay,
            'visit'     => $visit,
            'sales'     => $sales,
            'now'       => $now,
            'products'  => $products,
            'users'     => $users,
            'payments'  => $payments,
            'cancelled' => $cancelled,]);

        $report = Report::create([
            'file' => 'nbghjj',
        ]);
        ProcessReport::dispatch($report);
        Storage::disk('public')->put(date('Y-m-d-H-i-s').'-reports.orders',$pdf);

        return $pdf->setPaper('a4', 'landscape')->download('orderpdf.pdf');
    }

    /**
     * @return mixed
     */
    public function reportAnual()
    {
        $now = new \DateTime();

        $visit = Product::orderBy('visits', 'desc')
            ->take(4)->get(['name', 'id', 'visits']);

        $sales = Product::orderBy('sales', 'desc')
            ->take(4)->get(['name', 'id', 'sales']);

        $hoy = Order::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
        $pay = Payment::whereDate('updated_at', '=', now()->format('Y-m-d'))->count();
        $products = Product::whereDate('created_at', '>=', now()
            ->subYears(1)
            ->format('Y-m-d'))
            ->count();

        $users = User::whereDate('created_at', '>=', now()
            ->subYears(1000)
            ->format('Y-m-d'))
            ->count();

        $payments = Payment::whereDate('updated_at', '>=', now()
            ->subYears(1000)
            ->format('Y-m-d'))
            ->count();

        $cancelled = Cancelled::whereDate('updated_at', '>=', now()
            ->subYears(1000)
            ->format('Y-m-d'))
            ->count();

        $user = User::all();
        $product = Product::all();
        $order = Order::all();
        $payment = Payment::where('created_at', '>=', now()->subYears(1))->get();

        $pdf = \PDF::loadView('reports.reportAnual',[
            'payment'   => $payment,
            'product'   => $product,
            'user'      => $user,
            'order'     => $order,
            'hoy'       => $hoy,
            'pay'       => $pay,
            'visit'     => $visit,
            'sales'     => $sales,
            'now'       => $now,
            'products'  => $products,
            'users'     => $users,
            'payments'  => $payments,
            'cancelled' => $cancelled,
        ]);

        ProcessReport::dispatch()->delay(now()->addMinutes(5));

        Storage::disk('public')->put(date('Y-m-d-H-i-s').'reports.reportAnual',$pdf);
        return $pdf->download('anualpdf.pdf');
    }
}
