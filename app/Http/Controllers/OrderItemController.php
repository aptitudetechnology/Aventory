<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStoreRequest;
use App\Http\Requests\OrderItemUpdateRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderItemController extends Controller
{

    /**
     * @param \App\Http\Requests\OrderItemStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemStoreRequest $request, Order $order)
    {
        Gate::authorize('update', $order);

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
        Gate::authorize('update', $orderItem->order);

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
        Gate::authorize('update', $orderItem->order);

        $orderItem->delete();

        return redirect()->back()->banner('Items removed!');
    }
}
