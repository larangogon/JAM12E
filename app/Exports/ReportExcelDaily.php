<?php

namespace App\Exports;

use App\Entities\Cancelled;
use App\Entities\Order;
use App\Entities\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExcelDaily implements FromView, ShouldAutoSize
{
    use Exportable;

    /**
     * @return View
     */
    public function view(): View
    {
        $fecha = now()->format('Y-m-d');
        $hoy = Order::whereDate('created_at', '=', now()
            ->format('Y-m-d'))
            ->count();

        $pay = Payment::where('status', 'APPROVED')
            ->whereDate('updated_at', '=', now()
                ->format('Y-m-d'))
            ->count();

        $rechazadas = Payment::where('status', 'REJECTED')
            ->whereDate('updated_at', '=', now()
                ->format('Y-m-d'))
            ->count();

        $pending = Payment::where('status', 'PENDING')
            ->whereDate('updated_at', '=', now()
                ->format('Y-m-d'))
            ->count();

        $orderlist = Order::where('status', '=', 'APPROVED')->get();

        $cancel = Cancelled::whereDate('updated_at', '=', now()->format('Y-m-d'))->count();

        return view('reports.excelDaily', [
            'hoy' => $hoy,
            'orderlist' => $orderlist,
            'pay' => $pay,
            'cancel' => $cancel,
            'fecha' => $fecha,
            'pending' => $pending,
            'rechazadas' => $rechazadas

        ]);
    }
}
