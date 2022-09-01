<?php

namespace App\Services;

use App\Http\Integrations\Connections\Requests\GetConnectionsRequest;
use App\Http\Integrations\Connections\Requests\DeleteConnectionRequest;
use App\Models\CodatRecord;

class CodatConnectionsService
{
    public function list($companyId)
    {
        $request = new GetConnectionsRequest($companyId);

        return $request->send()->json();
    }

    public function delete($companyId, $connectionId)
    {
        $request = new DeleteConnectionRequest($companyId, $connectionId);
        $request->send()->json();

        CodatRecord::where(function ($query) use ($companyId, $connectionId) {
            $query->where('company_id', $companyId)->where('connection_id', $connectionId);
        })->delete();
    }
}
