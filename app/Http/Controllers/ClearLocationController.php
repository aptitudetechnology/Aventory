<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClearLocationController extends Controller
{
    public function index(Request $request){
        $locations = $request->user()->currentTeam->blocks;
        return inertia('ClearLocations/Index', compact('locations'));
    }
}
