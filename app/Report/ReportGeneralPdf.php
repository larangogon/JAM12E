<?php

namespace App\Report;

use App\Entities\Cancelled;
use App\Entities\Detail;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Rating;
use App\Entities\User;
use Illuminate\Support\Facades\DB;

class ReportGeneralPdf
{
    public function view()
    {
        $now = new \DateTime();

        $price = DB::table('orders')->max('total');

        $visit = Product::orderBy('visits', 'desc')
            ->take(4)->get(['name', 'id', 'visits']);

        $sales = Product::orderBy('sales', 'desc')
            ->take(4)->get(['name', 'id', 'sales']);

        $hoy = Order::whereDate('created_at', '=', now()
            ->format('Y-m-d'))
            ->count();

        $pay = Payment::whereDate('updated_at', '=', now()
            ->format('Y-m-d'))
            ->count();

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

        $approved = DB::table('orders')
            ->where('status', 'APPROVED')
            ->count();

        $rejected = DB::table('orders')
            ->where('status', 'REJECTED')
            ->count();

        $sum = DB::table('orders')
            ->where('status', 'APPROVED')
            ->sum('total');

        $sumRechazada = DB::table('orders')
            ->where('status', 'REJECTED')
            ->sum('total');

        $sumPending = DB::table('orders')
            ->where('status', 'PENDING')
            ->sum('total');

        $order = Order::all();

        $ratinAllProducs = Rating::all()->sum('score');

        $rating = Rating::topRating()->get();

        $sizeSales = Detail::sizeSales()->get();

        $categorySales = Detail::categorySales()->get();

        $colorSales = Detail::colorSales()->get();

        $r = Detail::productSalesTotal()->get();

        return \PDF::loadView('reports.reportGeneral', [
            'colorSales'     => $colorSales,
            'categorySales'   => $categorySales,
            'sizeSales'       => $sizeSales,
            'r'               => $r,
            'ratinAllProducs' => $ratinAllProducs,
            'rating'          => $rating,
            'hoy'             => $hoy,
            'sum'             => $sum,
            'pay'             => $pay,
            'rejected'        => $rejected,
            'visit'           => $visit,
            'sales'           => $sales,
            'now'             => $now,
            'products'        => $products,
            'users'           => $users,
            'payments'        => $payments,
            'cancelled'       => $cancelled,
            'order'           => $order,
            'price'           => $price,
            'approved'        => $approved,
            'sumRechazada'    => $sumRechazada,
            'sumPending'      => $sumPending,
        ]);
    }
}