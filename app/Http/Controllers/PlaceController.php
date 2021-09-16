<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Block;
use App\Models\Place;
use App\Models\Plant;
use Illuminate\Support\Facades\Gate;

class PlaceController extends Controller
{

    public function store(PlaceStoreRequest $request)
    {
        $block = Block::find($request->block_id);
        Gate::authorize('update', $block);

        $rowNumber = $request->starting_row_num;

        for ($row = 1; $row <= $request->num_rows; $row++) {
            for ($plant = 1; $plant <= $request->num_plants_per_row; $plant++) {
                Place::firstOrCreate([
                    'block_id' => $request->block_id,
                    'row_number' => $rowNumber,
                    'plant_number' => $plant
                ]);
            }
            $rowNumber += 1;
        }

        return redirect()->back()->banner('Added places to block!');
    }

    public function update(PlaceUpdateRequest $request)
    {
        $block = Block::find($request->block_id);
        Gate::authorize('update', $block);

        $currentPlaces = Place::where('block_id', $request->block_id)->where('row_number', $request->row_number)->get();

        for ($plant = 1; $plant <= $request->num_places; $plant++) {
            Place::firstOrCreate([
                'block_id' => $request->block_id,
                'row_number' => $request->row_number,
                'plant_number' => $plant
            ]);
        }

        if ($currentPlaces->count() > $request->num_places) {
            $currentPlaces->where('plant_number', '>', $request->num_places)->each->delete();
        }

        return redirect()->back()->banner('Updated row');
    }
}
