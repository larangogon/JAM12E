<?php

namespace App\Observers;

use App\Entities\Order;
use App\Events\OrderIsCreated;

class OrderObserver
{
    /**
     * @param Order $order
     */
    public function updated(Order $order)
    {
        event(new OrderIsCreated($order));
    }
}
