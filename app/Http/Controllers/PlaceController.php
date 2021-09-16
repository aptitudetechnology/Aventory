<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlaceStoreRequest;
use App\Models\Place;

class PlaceController extends Controller
{

    public function store(PlaceStoreRequest $request)
    {
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
}
