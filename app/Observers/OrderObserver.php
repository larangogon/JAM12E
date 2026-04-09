<?php

namespace App\Observers;

use App\Constants\Statuses;
use App\Entities\Order;
use App\Events\OrderIsCreated;
use App\Jobs\OrderActuality;

class OrderObserver
{
    /**
     * @param Order $order
     */
    public function created(Order $order)
    {
        if ($order->status === Statuses::APPROVED_IN_STORE) {
            event(new OrderIsCreated($order));
        }
    }

    /**
     * @param Order $order
     */
    public function updated(Order $order)
    {
        if ($order->status === 'APPROVED') {
            OrderActuality::dispatch($order)->delay(now()->addMinutes(1));
        }

        event(new OrderIsCreated($order));
    }
}
