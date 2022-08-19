<?php

namespace App\Services;

use App\Http\Integrations\Accounting\Requests\CreateCustomerRequest;
use App\Http\Integrations\Accounting\Requests\UpdateCustomerRequest;
use App\Models\CodatPushOperation;
use App\Models\Customer;

class CodatAccountingService
{
    protected function createOrUpdateCustomerResponseReceived(Customer $customer, $response)
    {
        $customer->codat_push_status = $response['status'];
        $customer->saveQuietly();

        $pushOp = new CodatPushOperation();
        $pushOp->id = $response['pushOperationKey'];
        $pushOp->company_id = $response['companyId'];
        $customer->codatPushOp()->save($pushOp);
    }

    public function sendCreateCustomerRequest(Customer $customer)
    {
        $request = new CreateCustomerRequest(
            companyId: $customer->team->codat_company_id,
            connectionId: $customer->team->codat_accounting_connection_id
        );

        $request->setData(['customerName' => $customer->name, 'status' => 'Active']);
        $response = $request->send()->json();

        $this->createOrUpdateCustomerResponseReceived($customer, $response);
    }

    public function sendUpdateCustomerRequest(Customer $customer)
    {
        $request = new UpdateCustomerRequest(
            companyId: $customer->team->codat_company_id,
            connectionId: $customer->team->codat_accounting_connection_id,
            customerId: $customer->codat_record_id
        );

        $request->setData(['customerName' => $customer->name, 'status' => 'Active']);
        $response = $request->send()->json();

        $this->createOrUpdateCustomerResponseReceived($customer, $response);
    }
}
