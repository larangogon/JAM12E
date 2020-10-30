<?php

namespace App\Listeners;

use App\Actions\Metrics\CancelledStoreMetricAction;
use App\Events\CancelledIsCreated;

class StoreCancelledInMetrics
{
    /**
     * @param CancelledIsCreated $event
     */
    public function handle(CancelledIsCreated $event)
    {
        CancelledStoreMetricAction::execute($event->cancelled);
    }
}
