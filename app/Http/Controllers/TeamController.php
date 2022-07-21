<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Accounting\Requests\CreateCompanyRequest;
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
}
