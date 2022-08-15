<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Connections\Requests\DisconnectRequest;
use App\Http\Integrations\Connections\Requests\GetConnectionsRequest;
use Arr;
use Illuminate\Support\Facades\Auth;

class CodatController extends Controller
{
    public function link()
    {
        $team = Auth::user()->currentTeam;

        $request = new GetConnectionsRequest(companyId: $team->codat_company_id);
        $response = $request->send()->json();

        $linkedAccountingConnection = Arr::first($response['connections'], function ($connection) {
            return $connection['status'] === 'Linked' && $connection['sourceType'] === 'Accounting';
        });

        $team->codat_accounting_connection_id = $linkedAccountingConnection ? $linkedAccountingConnection['id'] : null;
        $team->codat_accounting_platform_name = $linkedAccountingConnection ? $linkedAccountingConnection['platFormName'] : null;
        $team->save();

        return redirect()->route('teams.show', $team);
    }

    public function disconnect($connectionId)
    {
        $team = Auth::user()->currentTeam;

        $request = new DisconnectRequest(
            companyId: $team->codat_company_id,
            connectionId: $connectionId
        );
        $request->setData(['status' => 'Unlinked']);
        $response = $request->send()->json();

        return redirect()->route('teams.show', $team);
    }
}
