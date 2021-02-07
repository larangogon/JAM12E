<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Report;
use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessReportGeneralExcel;
use App\Jobs\ProcessReportProductExcel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportUsers(): BinaryFileResponse
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportProducts(): BinaryFileResponse
    {
        return Excel::download(new ProductsExport(), 'products.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportOrders(): BinaryFileResponse
    {
        return Excel::download(new OrdersExport(), 'orders.xlsx');
    }

    /**
     * @return RedirectResponse
     */
    public function reportGeneralExport(): RedirectResponse
    {
        $details['email'] = config('app.emailReport');

        dispatch(new ProcessReportGeneralExcel($details));

        $name = date('Y-m-d-H-i') . 'reporte.xlsx';
        $report = Report::create([
            'created_by' => auth()->user()->id,
            'file'       => $name,
            'type'       => 'Excel',
            'name'       => 'Reporte en excel',
        ]);

        return redirect()->back()
            ->with('success', 'El reporte se ha generado, verifica tu correo!');
    }

    /**
     * @return RedirectResponse
     */
    public function reportProductExport(): RedirectResponse
    {
        $details['email'] = config('app.emailReport');

        dispatch(new ProcessReportProductExcel($details));

        $name = date('Y-m-d-H-i') . 'reporte.xlsx';
        $report = Report::create([
            'created_by' => auth()->user()->id,
            'file'       => $name,
            'type'       => 'Excel',
            'name'       => 'Reporte en excel de productos',
        ]);

        return redirect()->back()
            ->with('success', 'El reporte se ha generado, verifica tu correo!');
    }

    /**
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function ruteExcel(Request $request)
    {
        $file = $request->file;
        $name = '/app/' . $file;

        $rutaDeArchivo = storage_path() . $name;

        return response()->download($rutaDeArchivo);
    }
}
