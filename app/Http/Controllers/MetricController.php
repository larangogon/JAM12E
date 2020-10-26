<?php

namespace App\Http\Controllers;

use App\Entities\Order;
use App\Entities\Payment;
use App\Metrics\MetricsManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class MetricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $hoy = Order::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();
        $pay = Payment::whereDate('updated_at', '=', Carbon::now()->format('Y-m-d'))->count();

        return view('metrics.index')->with(['hoy' => $hoy, 'pay' => $pay]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param string $metricSlug
     * @return JsonResponse
     */
    public function show(Request $request, string $metricSlug): JsonResponse
    {
        $metric = config('metrics.' . $metricSlug) ?? abort(404);

        $filter = json_decode($request->get('filter'), true) ?? [];

        $data = (new MetricsManager(new $metric['behaviour']()))->read($filter);

        return response()->json([
            'metric' => $data,
        ]);
    }
}
