<?php

namespace App\Http\Controllers;

use App\Http\Requests\NurseryLocationStoreRequest;
use App\Http\Requests\NurseryLocationUpdateRequest;
use App\Models\NurseryLocation;
use Illuminate\Http\Request;

class NurseryLocationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nurseryLocations = NurseryLocation::all();

        return view('nurseryLocation.index', compact('nurseryLocations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('nurseryLocation.create');
    }

    /**
     * @param \App\Http\Requests\NurseryLocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NurseryLocationStoreRequest $request)
    {
        $nurseryLocation = NurseryLocation::create($request->validated());

        $request->session()->flash('nurseryLocation.id', $nurseryLocation->id);

        return redirect()->route('nurseryLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NurseryLocation $nurseryLocation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, NurseryLocation $nurseryLocation)
    {
        return view('nurseryLocation.show', compact('nurseryLocation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NurseryLocation $nurseryLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, NurseryLocation $nurseryLocation)
    {
        return view('nurseryLocation.edit', compact('nurseryLocation'));
    }

    /**
     * @param \App\Http\Requests\NurseryLocationUpdateRequest $request
     * @param \App\Models\NurseryLocation $nurseryLocation
     * @return \Illuminate\Http\Response
     */
    public function update(NurseryLocationUpdateRequest $request, NurseryLocation $nurseryLocation)
    {
        $nurseryLocation->update($request->validated());

        $request->session()->flash('nurseryLocation.id', $nurseryLocation->id);

        return redirect()->route('nurseryLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NurseryLocation $nurseryLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, NurseryLocation $nurseryLocation)
    {
        $nurseryLocation->delete();

        return redirect()->route('nurseryLocation.index');
    }
}
