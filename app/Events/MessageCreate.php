<?php

namespace App\Events;

use App\Entities\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreate
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $message;

    /**
     * MessageCreate constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
}
