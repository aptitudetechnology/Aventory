<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\InventoryArchive;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Team;
use App\Observers\CustomerObserver;
use App\Observers\InventoryArchiveObserver;
use App\Observers\OrderDiscountObserver;
use App\Observers\OrderItemObserver;
use App\Observers\OrderObserver;
use App\Observers\QuoteObserver;
use App\Observers\TeamObserver;
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
        Team::observe(TeamObserver::class);
        Quote::observe(QuoteObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        OrderDiscount::observe(OrderDiscountObserver::class);
        InventoryArchive::observe(InventoryArchiveObserver::class);
        Customer::observe(CustomerObserver::class);
    }
}
