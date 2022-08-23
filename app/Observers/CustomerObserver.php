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
        $team = $customer->team;
        if ($team->accounting_connected) {
            $record = $this->codatAccountingService->createCustomer(
                companyId: $team->codat_company_id,
                connectionId: $team->codat_accounting_connection_id,
                data: ['customerName' => $customer->name, 'status' => 'Active']
            );
            $customer->codatRecord()->save($record);
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
        $team = $customer->team;
        if ($team->accounting_connected) {
            $this->codatAccountingService->updateCustomer(
                companyId: $team->codat_company_id,
                connectionId: $team->codat_accounting_connection_id,
                customerId: $customer->codatRecord->record_id,
                data: ['customerName' => $customer->name, 'status' => 'Active']
            );
        }
    }
}
