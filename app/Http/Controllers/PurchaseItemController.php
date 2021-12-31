<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseItemStoreRequest;
use App\Http\Requests\PurchaseItemUpdateRequest;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseItemController extends Controller
{

    /**
     * @param \App\Http\Requests\PurchaseItemStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseItemStoreRequest $request, Purchase $purchase)
    {
        Gate::authorize('update', $purchase);

        $purchaseItem = $purchase->purchaseItems()->create($request->validated());

        $request->session()->flash('purchaseItem.id', $purchaseItem->id);

        return redirect()->back()->banner('Added item!');
    }

    /**
     * @param \App\Http\Requests\PurchaseItemUpdateRequest $request
     * @param \App\Models\PurchaseItem $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseItemUpdateRequest $request, PurchaseItem $purchaseItem)
    {
        Gate::authorize('update', $purchaseItem->purchase);

        $purchaseItem->update($request->validated());

        $request->session()->flash('purchaseItem.id', $purchaseItem->id);

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PurchaseItem $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PurchaseItem $purchaseItem)
    {
        Gate::authorize('update', $purchaseItem->purchase);

        $purchaseItem->delete();

        return redirect()->back()->banner('Items removed!');
    }
}
