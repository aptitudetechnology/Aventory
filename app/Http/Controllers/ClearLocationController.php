<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClearLocationRequest;
use App\Models\Block;

class ClearLocationController extends Controller
{
    public function index(Request $request){
        $nurseries = $request->user()->currentTeam->nurseryLocations;
        return inertia('ClearLocations/Index', compact('nurseries'));
    }

    public function clear(ClearLocationRequest $request, Block $block){
        $places = $block->places()->where('row_number', '>=', $request->starting_row)->where('row_number', '<=', $request->ending_row)->get();
      
        foreach($places as $place){
            if($place->inventory != null){
                $place->inventory->update(['place_id' => null]);
            }
        }

        return back()->banner("Successfully cleared locations in $block->name block, rows: $request->starting_row - $request->ending_row");
    }
}
