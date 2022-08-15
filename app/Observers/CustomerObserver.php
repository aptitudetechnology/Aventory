<?php

namespace App\Observers;

use App\Http\Integrations\Accounting\Requests\CreateCustomerRequest;
use App\Http\Integrations\Accounting\Requests\UpdateCustomerRequest;
use App\Models\CodatPushOperation;
use App\Models\Customer;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        if ($customer->team->accounting_connected) {
            $request = new CreateCustomerRequest(
                companyId: $customer->team->codat_company_id,
                connectionId: $customer->team->codat_accounting_connection_id
            );
            $request->setData(['customerName' => $customer->name, 'status' => 'Active']);
            $response = $request->send()->json();

            $customer->codat_push_status = $response['status'];
            $customer->saveQuietly();

            $pushOp = new CodatPushOperation();
            $pushOp->id = $response['pushOperationKey'];
            $pushOp->company_id = $response['companyId'];
            $customer->codatPushOp()->save($pushOp);
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
            $request = new UpdateCustomerRequest(
                companyId: $customer->team->codat_company_id,
                connectionId: $customer->team->codat_accounting_connection_id,
                customerId: $customer->codat_record_id
            );
            $request->setData(['customerName' => $customer->name, 'status' => 'Active']);
            $response = $request->send()->json();

            $customer->codat_push_status = $response['status'];
            $customer->saveQuietly();

            $pushOp = new CodatPushOperation();
            $pushOp->id = $response['pushOperationKey'];
            $pushOp->company_id = $response['companyId'];
            $customer->codatPushOp()->save($pushOp);
        }
    }
}
