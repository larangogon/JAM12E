<?php

namespace App\Observers;

use App\Events\MessageCreate;

class MessagesObserver
{
    /**
     * @param $message
     */
    public function created($message)
    {
        event(new MessageCreate($message));
    }
}
