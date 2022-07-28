<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FeatureController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $features = $this->getFeatures($request);

        return inertia('Features/Index', compact('features'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Feature::class);

        $features = $this->getFeatures($request);

        return inertia('Features/Create', compact('features'));
    }

    /**
     * @param  \App\Http\Requests\FeatureStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureStoreRequest $request)
    {
        $feature = $request->user()->currentTeam->features()->create($request->validated());

        $request->session()->flash('feature.id', $feature->id);

        return redirect()->route('features.index')->banner('Sweet! Successfully created a new plant feature.');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Feature $feature)
    {
        Gate::authorize('view', $feature);

        $features = $this->getFeatures($request);

        return inertia('Features/Show', compact('feature', 'features'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Feature $feature)
    {
        return redirect()->route('features.show', $feature);
    }

    /**
     * @param  \App\Http\Requests\FeatureUpdateRequest  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureUpdateRequest $request, Feature $feature)
    {
        $feature->update($request->validated());

        $request->session()->flash('feature.id', $feature->id);

        return redirect()->route('features.show', $feature)->banner('Good Job! Feature was updated.');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Feature $feature)
    {
        Gate::authorize('delete', $feature);

        $feature->delete();

        return redirect()->route('features.index')->banner('Deleted a feature!');
    }

    protected function getFeatures($request)
    {
        return $request->user()->currentTeam->features;
    }
}
