<?php

namespace App\Listeners;

use App\Entities\User;
use App\Notifications\ProductNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class ProductExhaustedNotification
{
    /**
     * ProductExhaustedNotification constructor.
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

        Notification::send($admins, new ProductNotification($event->product));
    }
}
