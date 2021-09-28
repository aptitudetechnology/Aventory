<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InventoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Inventory/Index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('inventory.create');
    }

    /**
     * @param \App\Http\Requests\InventoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryStoreRequest $request)
    {
        
        $orderItems = OrderItem::whereIn('id', $request->selectedItems)->get();

        foreach ($orderItems as $item) {
            Gate::authorize('update', $item->order);

            if ($request->type == 'group') {
                $item->addToGroupInventory($request->block_id, $request->nursery_location_id);
            } elseif ($request->type == 'individual') {
                $item->addToIndividualInventory($request->block_id, $request->nursery_location_id);
            }
        }

        return redirect()->back()->banner('Items added to inventory!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Inventory $inventory)
    {
        $sizes = $request->user()->currentTeam->sizes;
        $inventory->load('block', 'place');
        $blocks = $request->user()->currentTeam->blocks->where('nursery_location_id', $inventory->nursery_location_id);
        return inertia('Inventory/Show', compact('inventory', 'sizes', 'blocks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * @param \App\Http\Requests\InventoryUpdateRequest $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryUpdateRequest $request, Inventory $inventory)
    {
        $place = Place::find($request->place_id);

        if($place && $place->inventory && $place->inventory->id != $inventory->id){
            $place->inventory->update(['place_id' => null]);
        }

        $inventory->update($request->validated());

        $request->session()->flash('inventory.id', $inventory->id);

        return redirect()->back()->banner('Great! Updated item.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index');
    }
}
