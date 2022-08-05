<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PlantFeaturesController extends Controller
{
    public function update(Request $request, Plant $plant)
    {
        Gate::authorize('update', $plant->product);
        $plant->features()->sync($request->features);

        return redirect()->route('products.show', $plant->product_id)->banner("Great Work! You've updated this plant's features.");
    }
}
