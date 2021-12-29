<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryArchiveStoreRequest;
use Illuminate\Http\Request;
use App\Models\InventoryArchive;
use Illuminate\Support\Facades\Gate;

class ApiInventoryArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InventoryArchive::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryArchive  $inventoryArchive
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryArchive $inventoryArchive)
    {
        return $inventoryArchive;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InventoryArchive  $inventoryArchive
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryArchiveStoreRequest $request, InventoryArchive $inventoryArchive)
    {
        $inventoryArchive->update($request->validated());
        return back()->banner('Inventory archive updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryArchive $inventoryArchive)
    {
        Gate::authorize('update', $inventoryArchive->inventory);

        $inventoryArchive->delete();

        return back()->banner('Inventory removed from archive and added back to inventory.');
    }
}
