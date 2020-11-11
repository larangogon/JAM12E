<?php

namespace App\Actions\Metrics;

use App\Entities\Metric;
use App\Entities\Order;

class StoreMetricAction
{
    public static function execute(Order $order): void
    {
        $metric = Metric::firstOrCreate([
            'status'     => $order->status,
            'primary_id' => $order->user_id,
            'date'       => $order->created_at->format('Y-m-d'),
        ]);

        $metric->total = ($metric->total ?? 0) + 1;

        $metric->save();
    }
}
