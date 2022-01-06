<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RemovePurchaseItemFromInventory extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $purchaseItem = PurchaseItem::find($request->item_id);

        Gate::authorize('update', $purchaseItem->purchase);

        $purchaseItem->removeFromInventory();
        return redirect()->back()->banner('Item removed from inventory.');
    }
}
