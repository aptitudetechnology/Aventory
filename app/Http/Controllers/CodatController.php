<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Accounting\Requests\DisconnectRequest;
use App\Http\Integrations\Accounting\Requests\GetConnectionsRequest;
use Arr;
use Illuminate\Support\Facades\Auth;

class CodatController extends Controller
{
    public function link()
    {
        $team = Auth::user()->currentTeam;

        $request = new GetConnectionsRequest($team->codat_company_id);
        $response = $request->send()->json();

        $team->connections = $response['results'];
        $team->save();

        return redirect()->route('teams.show', $team);
    }

    public function disconnect($connectionId)
    {
        $team = Auth::user()->currentTeam;

        $request = new DisconnectRequest($team->codat_company_id, $connectionId);
        $request->setData(['status' => 'Unlinked']);
        $response = $request->send()->json();

        $team->connections = Arr::map($team->connections, function ($connection) use ($response) {
            return $connection['id'] === $response['id'] ? $response : $connection;
        });

        $team->save();

        return redirect()->route('teams.show', $team);
    }
}
