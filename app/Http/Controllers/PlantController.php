<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantStoreRequest;
use App\Http\Requests\PlantUpdateRequest;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plants = Plant::all();

        return view('plant.index', compact('plants'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('plant.create');
    }

    /**
     * @param \App\Http\Requests\PlantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlantStoreRequest $request)
    {
        $plant = Plant::create($request->validated());

        $request->session()->flash('plant.id', $plant->id);

        return redirect()->route('plant.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plant $plant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Plant $plant)
    {
        return view('plant.show', compact('plant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plant $plant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Plant $plant)
    {
        return view('plant.edit', compact('plant'));
    }

    /**
     * @param \App\Http\Requests\PlantUpdateRequest $request
     * @param \App\Models\Plant $plant
     * @return \Illuminate\Http\Response
     */
    public function update(PlantUpdateRequest $request, Plant $plant)
    {
        $plant->update($request->validated());

        $request->session()->flash('plant.id', $plant->id);

        return redirect()->route('plant.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plant $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Plant $plant)
    {
        $plant->delete();

        return redirect()->route('plant.index');
    }
}
