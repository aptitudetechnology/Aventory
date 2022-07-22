<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Accounting\Requests\CreateCompanyRequest;
use App\Http\Integrations\Accounting\Requests\DeleteCompanyRequest;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function connect()
    {
        $team = Auth::user()->currentTeam;

        $request = new CreateCompanyRequest();
        $request->setData(['name' => $team->name]);
        $response = $request->send()->json();

        $team->codat_company_id = $response['id'];
        $team->save();

        return ['redirectUrl' => $response['redirect']];
    }

    public function disconnect()
    {
        $team = Auth::user()->currentTeam;

        $request = new DeleteCompanyRequest($team->codat_company_id);
        $request->send();

        $team->codat_company_id = null;
        $team->save();
    }
}