<?php

namespace App\Events;

use App\Entities\Cancelled;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CancelledIsCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $cancelled;

    /**
     * OrderIsCreated constructor.
     * @param Cancelled $cancelled
     */
    public function __construct(Cancelled $cancelled)
    {
        $this->cancelled = $cancelled;
    }
}
