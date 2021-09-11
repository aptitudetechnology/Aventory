<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RemoveOrderItemFromInventory extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $orderItem = OrderItem::find($request->item_id);

        Gate::authorize('update', $orderItem->order);

        $orderItem->removeFromInventory();
        return redirect()->back()->banner('Item removed from inventory.');
    }
}
