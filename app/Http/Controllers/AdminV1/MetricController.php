<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Cancelled;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\User;
use App\Metrics\MetricsManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class MetricController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $now = new \DateTime();

        $visit = Product::orderBy('visits', 'desc')
            ->take(4)->get(['name', 'id', 'visits']);

        $sales = Product::orderBy('sales', 'desc')
            ->take(4)->get(['name', 'id', 'sales']);

        $hoy = Order::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
        $pay = Payment::whereDate('updated_at', '=', now()->format('Y-m-d'))->count();
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

        return view('metrics.index')->with([
            'hoy'       => $hoy,
            'pay'       => $pay,
            'visit'     => $visit,
            'sales'     => $sales,
            'now'       => $now,
            'products'  => $products,
            'users'     => $users,
            'payments'  => $payments,
            'cancelled' => $cancelled,
        ]);
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
