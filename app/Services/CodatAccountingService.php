<?php

namespace App\Services;

use App\Http\Integrations\Accounting\Requests\CreateCustomerRequest;
use App\Http\Integrations\Accounting\Requests\UpdateCustomerRequest;
use App\Models\CodatRecord;

class CodatAccountingService
{
    public function createCustomer($companyId, $connectionId, array $data = [])
    {
        $request = new CreateCustomerRequest(
            companyId: $companyId,
            connectionId: $connectionId
        );
        $request->setData($data);

        ['pushOperationKey' => $pushId, 'status' => $pushStatus] = $request->send()->json();

        $record = new CodatRecord();
        $record->company_id = $companyId;
        $record->connection_id = $connectionId;
        $record->push_id = $pushId;
        $record->push_status = $pushStatus;

        return $record;
    }

    public function updateCustomer($companyId, $connectionId, $customerId, $data)
    {
        $request = new UpdateCustomerRequest(
            companyId: $companyId,
            connectionId: $connectionId,
            customerId: $customerId
        );

        $request->setData($data);

        ['pushOperationKey' => $pushId, 'status' => $pushStatus] = $request->send()->json();

        $record = CodatRecord::where(function ($query) use ($connectionId, $customerId) {
            $query->where('connection_id', $connectionId)->where('record_id', $customerId);
        })->first();
        $record->push_id = $pushId;
        $record->push_status = $pushStatus;
        $record->save();
    }
}
