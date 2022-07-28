<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStoreRequest;
use App\Http\Requests\OrderItemUpdateRequest;
use App\Models\OrderItem;
use App\Models\Sale;
use Illuminate\Support\Facades\Gate;

class OrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemStoreRequest $request, Sale $sale)
    {
        $sale->items()->create($request->validated());

        return redirect()->back()->banner('Item added to order.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderItemUpdateRequest $request, Sale $sale, OrderItem $item)
    {
        $item->update($request->validated());

        return redirect()->back()->banner('Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, OrderItem $item)
    {
        Gate::authorize('update', $sale);

        $item->delete();

        return redirect()->back()->banner('Item deleted.');
    }
}
