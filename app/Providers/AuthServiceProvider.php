<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\CustomerPriceLevel;
use App\Models\Team;
use App\Models\Vendor;
use App\Policies\ContactPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\CustomerPriceLevelPolicy;
use App\Policies\TeamPolicy;
use App\Policies\VendorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        Customer::class => CustomerPolicy::class,
        CustomerPriceLevel::class => CustomerPriceLevelPolicy::class,
        Contact::class => ContactPolicy::class,
        Vendor::class => VendorPolicy::class,
        Inventory::class => InventoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
