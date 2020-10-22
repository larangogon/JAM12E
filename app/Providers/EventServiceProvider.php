<?php

namespace App\Providers;

use App\Entities\Order;
use App\Entities\User;
use App\Entities\Product;
use App\Entities\Payment;
use App\Entities\Shipping;
use App\Events\OrderIsCreated;
use App\Events\PaymentIsCreated;
use App\Listeners\StoreOrderInMetrics;
use App\Listeners\StorePaymentInMetrics;
use App\Observers\OrderObserver;
use App\Observers\PaymentMetricObserver;
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
        OrderIsCreated::class => [
            StoreOrderInMetrics::class,
        ],
        PaymentIsCreated::class => [
            StorePaymentInMetrics::class,
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

        Payment::observe(PaymentMetricObserver::class);
        Order::observe(OrderObserver::class);
        User::observe(UserObserver::class);
        Shipping::observe(ShippingObserver::class);
        Payment::observe(PaymentObserver::class);
        Product::observe(ProductsObserver::class);
    }
}
