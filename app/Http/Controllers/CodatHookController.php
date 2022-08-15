<?php

namespace App\Http\Controllers;

use App\Http\Integrations\DataPush\Requests\GetPushOperationRecordRequest;
use App\Models\CodatPushOperation;
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

        $pushOp = CodatPushOperation::find($pushOperationId);
        $pushOp->pushable->codat_push_status = $status;
        $pushOp->pushable->codat_record_id = $response['data']['id'];
        $pushOp->pushable->save();
    }
}
