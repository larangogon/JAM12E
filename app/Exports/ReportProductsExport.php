<?php

namespace App\Exports;

use App\Entities\Detail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProductsExport implements FromView, ShouldAutoSize
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
}
