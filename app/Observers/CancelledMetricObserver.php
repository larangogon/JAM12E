<?php

namespace App\Observers;

use App\Entities\Cancelled;
use App\Events\CancelledIsCreated;

class CancelledMetricObserver
{
    /**
     * @param Cancelled $cancelled
     */
    public function created(Cancelled $cancelled)
    {
        event(new CancelledIsCreated($cancelled));
    }
}
