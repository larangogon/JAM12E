<?php

namespace App\Providers;

use App\User;
use App\Product;
use App\Payment;
use App\Shipping;
use App\Observers\UserObserver;
use App\Observers\ShippingObserver;
use App\Observers\PaymentObserver;
use App\Observers\ProductsObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        User::observe(UserObserver::class);
        Shipping::observe(ShippingObserver::class);
        Payment::observe(PaymentObserver::class);
        Product::observe(ProductsObserver::class);
    }
}
