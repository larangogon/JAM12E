<?php

namespace App\Listeners;

use App\Actions\Metrics\StoreMetricAction;
use App\Events\OrderIsCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreOrderInMetrics
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param OrderIsCreated $event
     */
    public function handle(OrderIsCreated $event)
    {
        StoreMetricAction::execute($event->order);
    }
}
