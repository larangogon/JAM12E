<?php

namespace App\Actions\Metrics;

use App\Entities\MetricPayment;
use App\Entities\Payment;

class PaymentStoreMetricAction
{
    /**
     * @param Payment $payment
     */
    public static function execute(Payment $payment): void
    {
        $metric = MetricPayment::firstOrCreate([
            'status'     => $payment->status,
            'primary_id' => $payment->order_id,
            'date'       => $payment->created_at->format('Y-m-d'),
        ]);

        $metric->total = ($metric->total ?? 0) + 1;

        $metric->save();
    }
}
