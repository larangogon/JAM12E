<?php

namespace App\Providers;

use App\Constants\PlaceToPay;
use App\Decorators\DecoratorRol;
use App\Decorators\DecoratorCart;
use App\Decorators\DecoratorSize;
use App\Decorators\DecoratorUser;
use App\Decorators\DecoratorOrder;
use App\Decorators\DecoratorColor;
use App\Interfaces\InterfaceSizes;
use App\Interfaces\InterfaceRoles;
use App\Interfaces\InterfaceCarts;
use App\Interfaces\InterfaceUsers;
use App\Interfaces\InterfaceOrders;
use App\Interfaces\InterfaceColors;
use App\Decorators\DecoratorProduct;
use App\Decorators\DecoratorCategory;
use App\Interfaces\InterfaceProducts;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\InterfaceCategories;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PlaceToPay::class);
        Schema::defaultStringLength(191);
        $this->app->bind(InterfaceCarts::class, DecoratorCart::class);
        $this->app->bind(InterfaceRoles::class, DecoratorRol::class);
        $this->app->bind(InterfaceSizes::class, DecoratorSize::class);
        $this->app->bind(InterfaceUsers::class, DecoratorUser::class);
        $this->app->bind(InterfaceColors::class, DecoratorColor::class);
        $this->app->bind(InterfaceOrders::class, DecoratorOrder::class);
        $this->app->bind(InterfaceProducts::class, DecoratorProduct::class);
        $this->app->bind(InterfaceCategories::class, DecoratorCategory::class);
    }
}
