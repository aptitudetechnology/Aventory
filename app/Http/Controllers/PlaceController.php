<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Block;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PlaceController extends Controller
{
    public function index(Request $request, Block $block)
    {
        $places = cache()->rememberForever($block->id.'places', function () use ($block) {
            return $block->places;
        });

        return response()->json($places)->header('Cache-Control', 'public, max_age=60');
    }

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
                    'plant_number' => $plant,
                ]);
            }
            $rowNumber += 1;
        }

        cache()->forget($block->id.'places');

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
                'plant_number' => $plant,
            ]);
        }

        if ($currentPlaces->count() > $request->num_places) {
            $currentPlaces->where('plant_number', '>', $request->num_places)->each->delete();
        }
        cache()->forget($block->id.'places');

        return redirect()->back()->banner('Updated row');
    }
}
