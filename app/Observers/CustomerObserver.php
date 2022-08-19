<?php

namespace App\Observers;

use App\Models\Customer;
use App\Services\CodatAccountingService;

class CustomerObserver
{
    public function __construct(
        public CodatAccountingService $codatAccountingService
    ) {
    }

    /**
     * Handle the Customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        if ($customer->team->accounting_connected) {
            $this->codatAccountingService->sendCreateCustomerRequest($customer);
        }
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        if ($customer->team->accounting_connected) {
            $this->codatAccountingService->sendUpdateCustomerRequest($customer);
        }
    }
}
