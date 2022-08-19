<?php

namespace App\Http\Controllers;

use App\Http\Integrations\DataPush\Requests\GetPushOperationRecordRequest;
use App\Models\CodatPushOperation;
use App\Models\CodatRecord;
use Illuminate\Http\Request;

class CodatHookController extends Controller
{
    public function pushOperationStatusChanged(Request $request)
    {
        $pushOperationId = $request->input('Data.pushOperationKey');
        $companyId = $request->input('CompanyId');
        $status = $request->input('Data.status');

        $request = new GetPushOperationRecordRequest(
            companyId: $companyId,
            pushOperationKey: $pushOperationId
        );
        $response = $request->send()->json();

        $record = CodatRecord::where('push_id', $pushOperationId)->first();

        if ($record) {
            $record->push_status = $status;
            $record->record_id = $response['data']['id'];
            $record->saveQuietly();
        }
    }
}
