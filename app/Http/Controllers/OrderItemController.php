<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStoreRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemStoreRequest $request, Order $order)
    {
        $order->items()->create($request->validated());
        return redirect()->back()->banner('Item added to order.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderItemStoreRequest $request, Order $order, OrderItem $item)
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
    public function destroy(Order $order, OrderItem $item)
    {
        $item->delete();

        return redirect()->back()->banner('Item deleted.');
    }
}
