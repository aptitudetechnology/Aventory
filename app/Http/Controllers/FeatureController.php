<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $features = Feature::all();

        return view('feature.index', compact('features'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('feature.create');
    }

    /**
     * @param \App\Http\Requests\FeatureStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureStoreRequest $request)
    {
        $feature = Feature::create($request->validated());

        $request->session()->flash('feature.id', $feature->id);

        return redirect()->route('feature.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Feature $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Feature $feature)
    {
        return view('feature.show', compact('feature'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Feature $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Feature $feature)
    {
        return view('feature.edit', compact('feature'));
    }

    /**
     * @param \App\Http\Requests\FeatureUpdateRequest $request
     * @param \App\Models\Feature $feature
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureUpdateRequest $request, Feature $feature)
    {
        $feature->update($request->validated());

        $request->session()->flash('feature.id', $feature->id);

        return redirect()->route('feature.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Feature $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Feature $feature)
    {
        $feature->delete();

        return redirect()->route('feature.index');
    }
}
