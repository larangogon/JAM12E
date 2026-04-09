<?php

namespace App\Actions\Metrics;

use App\Entities\Cancelled;
use App\Entities\MetricCancelled;

class CancelledStoreMetricAction
{
    public static function execute(Cancelled $cancelled): void
    {
        $metric = MetricCancelled::firstOrCreate([
            'status' => $cancelled->status,
            'primary_id' => $cancelled->user_id,
            'date' => $cancelled->created_at->format('Y-m-d'),
        ]);

        $metric->total = ($metric->total ?? 0) + 1;

        $metric->save();
    }
}
