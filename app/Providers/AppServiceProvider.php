<?php

namespace App\Providers;

use App\Observers\OrderItemObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\OrderItem;

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
    }
}
