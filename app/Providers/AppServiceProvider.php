<?php

namespace App\Providers;

use App\Models\InventoryArchive;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Observers\OrderItemObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\OrderItem;
use App\Observers\OrderObserver;
use App\Observers\OrderDiscountObserver;
use App\Observers\InventoryArchiveObserver;

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
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        OrderDiscount::observe(OrderDiscountObserver::class);
        InventoryArchive::observe(InventoryArchiveObserver::class);
    }
}
