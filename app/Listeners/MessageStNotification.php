<?php

namespace App\Listeners;

use App\Entities\User;
use App\Notifications\MessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class MessageStNotification
{
    /**
     * MessageNotification constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $event
     */
    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Administrator');
        })->get();

        $user = $event->message->recipient_id;

        $recipient = User::whereHas('messagesRecipient', function ($query) use ($user) {
            $query->where('recipient_id', $user);
        })->get();

        Notification::send($admins, new MessageNotification($event->message));
        Notification::send($recipient, new MessageNotification($event->message));
    }
}
