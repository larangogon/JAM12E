<?php

namespace App\Exports;

use App\Entities\Detail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ReportProductsExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    /**
     * @return View
     */
    public function view(): View
    {
        $sizeSales = Detail::sizeSales()->get();

        $categorySales = Detail::categorySales()->get();

        $colorSales = Detail::colorSales()->get();

        $r = Detail::productSalesTotal()->get();

        return view('reports.excelProduct', [
            'colorSales'      => $colorSales,
            'categorySales'   => $categorySales,
            'sizeSales'       => $sizeSales,
            'r'               => $r,
        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
