<?php

namespace App\Http\Controllers;

use App\Services\CodatCompaniesService;
use App\Services\CodatConnectionsService;
use Arr;
use Illuminate\Support\Facades\Auth;

class CodatController extends Controller
{
    public function link(CodatConnectionsService $codatConnectionsService)
    {
        $team = Auth::user()->currentTeam;

        $response = $codatConnectionsService->list($team->codat_company_id);

        $linkedAccountingConnection = Arr::first($response['results'], function ($connection) {
            return $connection['status'] === 'Linked' && $connection['sourceType'] === 'Accounting';
        });

        $team->codat_accounting_connection_id = $linkedAccountingConnection ? $linkedAccountingConnection['id'] : null;
        $team->codat_accounting_platform_name = $linkedAccountingConnection ? $linkedAccountingConnection['platformName'] : null;
        $team->save();

        return redirect()->route('teams.show', $team);
    }

    public function disconnect(CodatCompaniesService $codatCompaniesService, CodatConnectionsService $codatConnectionsService)
    {
        $team = Auth::user()->currentTeam;

        $codatConnectionsService->delete($team->codat_company_id, $team->codat_accounting_connection_id);
        $team->codat_accounting_connection_id = null;

        $codatCompaniesService->delete($team->codat_company_id);
        $response = $codatCompaniesService->create(['name' => $team->name]);

        $team->codat_company_id = $response['id'];
        $team->save();

        return redirect()->route('teams.show', $team);
    }
}
