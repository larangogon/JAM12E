<?php

namespace App\Providers;

use App\Contracts\Api\ApiProductsContract;
use App\Contracts\CartsContract;
use App\Contracts\CategoriesContract;
use App\Contracts\ColorsContract;
use App\Contracts\OrdersContract;
use App\Contracts\ProductsContract;
use App\Contracts\RolesContract;
use App\Contracts\SizesContract;
use App\Contracts\UsersContract;
use App\Decorators\Api\DecoratorApiProduct;
use App\Decorators\DecoratorCart;
use App\Decorators\DecoratorCategory;
use App\Decorators\DecoratorColor;
use App\Decorators\DecoratorOrder;
use App\Decorators\DecoratorProduct;
use App\Decorators\DecoratorRol;
use App\Decorators\DecoratorSize;
use App\Decorators\DecoratorUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Writer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Writer::listen(BeforeExport::class, function () {
            //
        });

        Writer::listen(BeforeWriting::class, function () {
            //
        });

        Sheet::listen(BeforeSheet::class, function () {
            //
        });

        Sheet::listen(AfterSheet::class, function () {
            //
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(CartsContract::class, DecoratorCart::class);
        $this->app->bind(RolesContract::class, DecoratorRol::class);
        $this->app->bind(SizesContract::class, DecoratorSize::class);
        $this->app->bind(UsersContract::class, DecoratorUser::class);
        $this->app->bind(ColorsContract::class, DecoratorColor::class);
        $this->app->bind(OrdersContract::class, DecoratorOrder::class);
        $this->app->bind(ProductsContract::class, DecoratorProduct::class);
        $this->app->bind(CategoriesContract::class, DecoratorCategory::class);
        $this->app->bind(ApiProductsContract::class, DecoratorApiProduct::class);
    }
}
