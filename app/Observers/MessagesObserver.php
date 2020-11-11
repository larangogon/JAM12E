<?php

namespace App\Observers;

use App\Events\MessageCreate;

class MessagesObserver
{
    public function created($message)
    {
        event(new MessageCreate($message));
    }
}
