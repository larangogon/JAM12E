<?php

namespace App\Listeners;

use App\Actions\Metrics\PaymentStoreMetricAction;
use App\Events\PaymentIsCreated;

class StorePaymentInMetrics
{
    /**
     * @param PaymentIsCreated $event
     */
    public function handle(PaymentIsCreated $event)
    {
        PaymentStoreMetricAction::execute($event->payment);
    }
}
