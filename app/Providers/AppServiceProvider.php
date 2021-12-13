<?php

namespace App\Providers;

use App\Models\Order;
use App\Observers\OrderItemObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\OrderItem;
use App\Observers\OrderObserver;

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
        OrderItem::observe(OrderItemObserver::class);
        Order::observe(OrderObserver::class);
    }
}
