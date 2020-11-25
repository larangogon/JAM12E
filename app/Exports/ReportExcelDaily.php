<?php

namespace App\Exports;

use App\Entities\Cancelled;
use App\Entities\Order;
use App\Entities\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportExcelDaily implements FromView, ShouldAutoSize, WithEvents
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

        $orderlist = Order::select(DB::raw('*'))
            ->whereRaw('Date(created_at) = CURDATE()')
            ->get();

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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
