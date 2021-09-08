<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStoreRequest;
use App\Http\Requests\OrderItemUpdateRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    /**
     * @param \App\Http\Requests\OrderItemStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemStoreRequest $request, Order $order)
    {
        $orderItem = $order->orderItems()->create($request->validated());

        $request->session()->flash('orderItem.id', $orderItem->id);

        return redirect()->back()->banner('Added item!');
    }

    /**
     * @param \App\Http\Requests\OrderItemUpdateRequest $request
     * @param \App\Models\OrderItem $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(OrderItemUpdateRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->validated());

        $request->session()->flash('orderItem.id', $orderItem->id);

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderItem $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OrderItem $orderItem)
    {
        $orderItem->delete();

        return redirect()->route('orderItem.index');
    }
}
