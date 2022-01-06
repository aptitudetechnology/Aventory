<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Requests\PurchaseUpdateRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchases = $this->getPurchases();

        return inertia('Purchases/Index', compact('purchases'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Purchase::class);
        $purchases = $this->getPurchases();
        $vendors = $this->getVendors();
        return inertia('Purchases/Create', compact('purchases', 'vendors'));
    }

    /**
     * @param \App\Http\Requests\PurchaseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseStoreRequest $request)
    {
        Gate::authorize('create', Purchase::class);

        $purchase = $request->user()->currentTeam->purchases()->create($request->validated());

        $request->session()->flash('purchase.id', $purchase->id);

        return redirect()->route('purchases.show', $purchase)->banner('Great! Created purchase. Now add purchase items.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Purchase $purchase)
    {
        Gate::authorize('view', $purchase);

        $purchases = $this->getPurchases();
        $purchaseItems = $purchase->purchaseItems;
        $vendors = $this->getVendors();
        $products = $request->user()->currentTeam->products()->where('type', 'plant')->get();
        $sizes = $request->user()->currentTeam->sizes;
        $blocks = $request->user()->currentTeam->blocks;
        $nurseryLocations = $request->user()->currentTeam->nurseryLocations;
        return inertia('Purchases/Show', compact('purchases', 'vendors', 'purchase', 'products', 'sizes', 'purchaseItems', 'blocks', 'nurseryLocations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Purchase $purchase)
    {
        return redirect()->route('purchases.show', $purchase);
    }

    /**
     * @param \App\Http\Requests\PurchaseUpdateRequest $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseUpdateRequest $request, Purchase $purchase)
    {
        Gate::authorize('update', $purchase);

        $purchase->update($request->validated());

        $request->session()->flash('purchase.id', $purchase->id);

        return redirect()->route('purchases.show', $purchase)->banner('Updated purchase!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Purchase $purchase)
    {
        Gate::authorize('delete', $purchase);
        $purchase->delete();

        return redirect()->route('purchases.index')->banner('Deleted Purchase!');
    }

    protected function getPurchases()
    {
        return auth()->user()->currentTeam->purchases;
    }

    protected function getVendors()
    {
        return auth()->user()->currentTeam->vendors;
    }
}
