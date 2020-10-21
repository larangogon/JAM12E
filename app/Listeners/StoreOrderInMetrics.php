<?php

namespace App\Listeners;

use App\Actions\Metrics\StoreMetricAction;
use App\Events\OrderIsCreated;

class StoreOrderInMetrics
{
    /**
     * @param OrderIsCreated $event
     */
    public function handle(OrderIsCreated $event)
    {
        //StoreMetricAction::execute($event->order);
    }
}
