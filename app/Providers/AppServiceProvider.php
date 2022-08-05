<?php

namespace App\Providers;

use App\Models\InventoryArchive;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\OrderItem;
use App\Models\Quote;
use App\Observers\InventoryArchiveObserver;
use App\Observers\OrderDiscountObserver;
use App\Observers\OrderItemObserver;
use App\Observers\OrderObserver;
use App\Observers\QuoteObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

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
        Quote::observe(QuoteObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        OrderDiscount::observe(OrderDiscountObserver::class);
        InventoryArchive::observe(InventoryArchiveObserver::class);

        Relation::enforceMorphMap([
            'customers' => 'App\Models\Customer',
            'vendors' => 'App\Models\Vendor',
        ]);
    }
}
