<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeStoreRequest;
use App\Http\Requests\SizeUpdateRequest;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SizeController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sizes = $this->getSizes($request);

        return inertia('Sizes/Index', compact('sizes'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Size::class);

        return inertia('Sizes/Create');
    }

    /**
     * @param  \App\Http\Requests\SizeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeStoreRequest $request)
    {
        $size = $request->user()->currentTeam->sizes()->create($request->validated());

        $request->session()->flash('size.id', $size->id);

        return redirect()->route('sizes.index');
    }

    /**
     * @param  \App\Http\Requests\SizeUpdateRequest  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(SizeUpdateRequest $request, Size $size)
    {
        $size->update($request->validated());

        $request->session()->flash('size.id', $size->id);

        return redirect()->route('sizes.index')->banner('Good job! Updated Size.');
    }

    /**
     * Update all the order_nums to order sizes
     */
    public function updateOrder(Request $request)
    {
        foreach ($request->sizes as $updatedSize) {
            $size = Size::find($updatedSize['id']);

            Gate::authorize('update', $size);

            $size->update([
                'sort_num' => $updatedSize['sort_num'],
            ]);
        }
        session()->flash('flash.banner', 'Great work! Updated sort.');

        return redirect()->route('sizes.index');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Size $size)
    {
        Gate::authorize('delete', $size);
        $size->delete();

        return redirect()->route('sizes.index')->banner('Size removed.');
    }

    public function getSizes($request)
    {
        return $request->user()->currentTeam->sizes;
    }
}
