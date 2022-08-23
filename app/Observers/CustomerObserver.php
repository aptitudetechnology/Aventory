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
                $team->codat_company_id,
                $team->codat_accounting_connection_id,
                [
                    'customerName' => $customer->name, 'status' => 'Active'
                ]
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
                $team->codat_company_id,
                $team->codat_accounting_connection_id,
                $customer->codatRecord->record_id,
                ['customerName' => $customer->name, 'status' => 'Active']
            );
        }
    }
}
