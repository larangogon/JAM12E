<?php

namespace App\Events;

use App\Entities\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderIsCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $order;

    /**
     * OrderIsCreated constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order= $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
