<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Order;
use App\Entities\Report;
use App\Http\Requests\RequestFilter;
use App\Jobs\ProcessReportGeneral;
use App\Jobs\ProcessReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

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
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $this->authorize('report.index');

        if ($request) {
            $query = trim($request->get('search'));
        }

        $reports = Report::where('created_by', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(6);

        return view('reports.index', [
            'reports' => $reports,
            'search'  => $query
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $this->authorize('report.show');

        $factura = Order::find($id);
        $pdf = \PDF::loadView('reports.show', compact('factura'));
        return $pdf
            ->download('factura.pdf');
    }

    /**
     * @param RequestFilter $request
     * @return RedirectResponse
     */
    public function reportOrders(RequestFilter $request): RedirectResponse
    {
        $this->authorize('report.reportOrders');

        $fechaInicio = date('Y-m-d', strtotime($request->get('fechaInicio')));

        $fechaFinal = date('Y-m-d', strtotime($request->get('fechaFinal')));

        $status = $request->get('status');

        if ($fechaInicio > $fechaFinal) {
            return redirect()->back()->with(
                'success',
                'La fecha inicial es mayor que la final !'
            );
        }

        $ordersx = Order::whereBetween('created_at', [
            $fechaInicio . ' 00:00:00', $fechaFinal . ' 23:59:29'])
            ->where('status', $status)
            ->get();

        if ($status === "all") {
            $ordersx = Order::whereBetween('created_at', [
                $fechaInicio . ' 00:00:00', $fechaFinal . ' 23:59:29'])
                ->get();
        }

        $details['email'] = config('app.emailReport');
        dispatch(new ProcessReport($details, $ordersx));

        $name = date('Y-m-d-H-i') . 'report.pdf';

        $report = Report::create([
            'created_by' => auth()->user()->id,
            'file'       => $name,
            'type'       => 'PDF',
            'name'       => 'Reporte ordenes',
        ]);

        return redirect()->back()
            ->with('success', 'El reporte se ha generado, verifica tu correo !');
    }

    /**
     * @return RedirectResponse
     */
    public function reportGeneral(): RedirectResponse
    {
        $this->authorize('report.reportGeneral');

        $details['email'] = config('app.emailReport');

        dispatch(new ProcessReportGeneral($details));

        $name = date('Y-m-d-H-i') . 'report.pdf';
        $desp = 'Resumen General';

        $report = Report::create([
            'name'       => $desp,
            'created_by' => auth()->user()->id,
            'type'       => 'PDF',
            'file'       => $name,

        ]);

        return redirect()->back()
            ->with('success', 'El reporte se ha generado, verifica tu correo!');
    }

    /**
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('report.destroy');

        Report::destroy($id);

        return Redirect()->back()
            ->with('success', 'Eliminado Satisfactoriamente !');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function rute(Request $request)
    {
        $this->authorize('report.rute');

        $file = $request->file;
        $name = '/app/' . $file;

        $rutaDeArchivo = storage_path() . $name;

        return response()->download($rutaDeArchivo);
    }
}
