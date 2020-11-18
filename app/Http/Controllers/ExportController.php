<?php

namespace App\Http\Controllers;

use App\Entities\Report;
use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use App\Jobs\ProcessReportGeneralExcel;
use App\Jobs\ProcessReportProductExcel;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * ExportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->middleware('role:Administrator');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportUsers(): BinaryFileResponse
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportProducts(): BinaryFileResponse
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportOrders(): BinaryFileResponse
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportGeneralExport(): RedirectResponse
    {
        $details['email'] = 'johannitaarango2@gmail.com';

        dispatch(new ProcessReportGeneralExcel($details));

        $report = Report::create([
            'created_by' => auth()->user()->id,
            'file'       => 'Enviado al email johannitaarango2@gmail.com',
            'name'       => 'Reporte_excel',
        ]);

        return redirect()->back()
            ->with(
                'success',
                '...El reporte se ha generado, verifica tu correo!'
            );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportProductExport(): RedirectResponse
    {
        $details['email'] = 'johannitaarango2@gmail.com';

        dispatch(new ProcessReportProductExcel($details));

        $report = Report::create([
            'created_by' => auth()->user()->id,
            'file'       => 'Enviado al email johannitaarango2@gmail.com',
            'name'       => 'Reporte_excel',
        ]);

        return redirect()->back()
            ->with(
                'success',
                '...El reporte se ha generado, verifica tu correo!'
            );
    }
}
