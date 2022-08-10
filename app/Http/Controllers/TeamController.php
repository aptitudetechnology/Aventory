<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function updateLogo(Request $request)
    {
        $request->validate(['logo' => 'required|image']);
        $team = Auth::user()->currentTeam;

        $team->updateLogo($request->file('logo'));

        return ['logo_url' => $team->logo_url];
    }
}
