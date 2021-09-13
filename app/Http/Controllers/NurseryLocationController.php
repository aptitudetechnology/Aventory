<?php

namespace App\Http\Controllers;

use App\Http\Requests\NurseryLocationStoreRequest;
use App\Http\Requests\NurseryLocationUpdateRequest;
use App\Models\NurseryLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NurseryLocationController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = $this->getLocations();

        return inertia('NurseryLocations/Index', compact('locations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', NurseryLocation::class);

        $locations = $this->getLocations();
        return inertia('NurseryLocations/Create', compact('locations'));
    }

    /**
     * @param \App\Http\Requests\NurseryLocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NurseryLocationStoreRequest $request)
    {
        Gate::authorize('create', NurseryLocation::class);

        $nurseryLocation = auth()->user()->currentTeam->nurseryLocations()->create($request->validated());

        $request->session()->flash('nurseryLocation.id', $nurseryLocation->id);

        return redirect()->route('locations.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NurseryLocation $nurseryLocation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, NurseryLocation $location)
    {
        Gate::authorize('view', $location);
        $locations = $this->getLocations();
        return inertia('NurseryLocations/Show', compact('location', 'locations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NurseryLocation $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, NurseryLocation $location)
    {
        Gate::authorize('update', $location);
        $locations = $this->getLocations();
        return inertia('NurseryLocations/Edit', compact('location', 'locations'));
    }

    /**
     * @param \App\Http\Requests\NurseryLocationUpdateRequest $request
     * @param \App\Models\NurseryLocation $location
     * @return \Illuminate\Http\Response
     */
    public function update(NurseryLocationUpdateRequest $request, NurseryLocation $location)
    {
        Gate::authorize('update', $location);

        $location->update($request->validated());

        $request->session()->flash('location.id', $location->id);

        return redirect()->route('locations.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NurseryLocation $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, NurseryLocation $location)
    {
        Gate::authorize('delete', $location);

        $location->delete();

        return redirect()->route('locations.index');
    }

    protected function getLocations()
    {
        return auth()->user()->currentTeam->nurseryLocations;
    }
}
