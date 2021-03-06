<?php

namespace App\Exports;

use App\Entities\Cancelled;
use App\Entities\Detail;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Rating;
use App\Entities\Spending;
use App\Entities\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportGeneralExport implements FromView, ShouldAutoSize
{
    use Exportable;

    /**
     * @return View
     */
    public function view(): View
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

        $productosMasVendidos = Detail::productSalesTotal()->get();

        $gastos = Spending::spendinTotal()->get();

        $gastoMax = DB::table('spendings')->max('total');

        $gastoDescrip = DB::table('spendings')->max('description');

        $userTotalComprasMasAltas = Order::userSales()->get();


        return view('reports.reportExcel', [
            'userTotalComprasMasAltas'  => $userTotalComprasMasAltas,
            'gastoDescrip'    => $gastoDescrip,
            'gastoMax'        => $gastoMax,
            'gastos'          => $gastos,
            'colorSales'      => $colorSales,
            'categorySales'   => $categorySales,
            'sizeSales'       => $sizeSales,
            'productosMasVendidos' => $productosMasVendidos,
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
