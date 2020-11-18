<?php

namespace App\Metrics\Behaviour;

use App\Contracts\MetricContract;
use App\Entities\MetricPayment;
use Illuminate\Support\Collection;

class PaymentMetricBehaviour implements MetricContract
{
    /**
     * @param array $filters
     * @return Collection
     */
    public function read(array $filters): Collection
    {
        $primary = $filters['primary'] ?? null;

        $metrics =  MetricPayment::filterByPrimaryId($primary)
            ->whereBetween('date', [
                $filters['from'] ?? now()->subMonth()->format('Y-m-d'),
                $filters['to'] ?? now()->format('Y-m-d'),
            ])
            ->selectRaw('SUM(total) as `total`,
                `date` as `date`,
                `status`')
            ->groupBy('status', 'date')
            ->get(['date', 'status', 'total']);

        return MetricPayment::readThreeLevelsMetric($metrics);
    }
}
