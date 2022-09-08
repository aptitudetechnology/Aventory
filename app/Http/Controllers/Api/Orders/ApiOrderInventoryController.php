<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryArchiveStoreRequest;
use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Support\Facades\Gate;

class ApiOrderInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sale $sale)
    {
        Gate::authorize('update', $sale);

        return $sale->inventory();
    }

    /**
     * Endpoint that sees if an item is able to be added to the order.
     * If the item is not able to be added, it will return the reason why.
     * If the item is able to be added, it will return the inventory object.
     * if the item is not able to be automatically matched to an order item, it will return a list of items that may be able to be matched.(Same product, but not the same size.)
     */
    public function show(Sale $sale, Inventory $inventory)
    {
        Gate::authorize('update', $sale);
        $message = '';
        $orderItem = $sale->getItemMatchedToInventory($inventory);
        $match = $sale->getPerfectInventoryMatchForItem($inventory);
        $possibleItemMatches = $sale->getPossibleInventoryItemMatches($inventory);
        if ($inventory->quantity < 1) {
            $match = null;
            $possibleItemMatches = [];
            $inventory = null;
            $message = 'Not enough inventory to match. Please update.';
        } elseif ($orderItem) {
            $match = null;
        } elseif ($match) {
            $message = '';
        } elseif (count($possibleItemMatches) > 0) {
            $message = "Please select an order line item to match to {$inventory->id}.";
        } else {
            $message = "No items found that match the scanned item. Do you want to add {$inventory->product->name} in size {$inventory->size->name} to the order?";
        }

        return response()->json([
            'message' => $message,
            'inventory' => $inventory,
            'match' => $match,
            'matches' => $possibleItemMatches,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\InventoryArchiveStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryArchiveStoreRequest $request, Sale $sale)
    {
        $inventory = Inventory::findOrFail($request->input('inventory_id'));
        $items = $sale->items;

        $match = $items->find($request->input('order_item_id'));

        if (!$match) {
            $match = $sale->items()->create([
                'product_id' => $inventory->product_id,
                'size_id' => $inventory->size_id,
                'unit_price' => $inventory->product->getPrice($inventory->size, $sale->customer),
                'original_quantity' => $request->input('quantity_removed'),
                'quantity' => $request->input('quantity_removed'),
            ]);
        }

        $archived = $match->archived()->where(
            [
                ['order_item_id', '=', $match->id],
                ['inventory_id', '=', $inventory->id],
            ],

        )->first();

        if ($archived) {
            $archived->increment('quantity_removed', $request->input('quantity_removed'));
        } else {
            $match->archived()->create(
                [
                    'inventory_id' => $inventory->id,
                    'quantity_removed' => $request->input('quantity_removed'),
                    'removed_by_id' => auth()->user()->id,
                    'reason_removed' => 'Sold',
                    'was_adjustment' => false,
                ]
            );
        }

        if (!$match->is_matched) {
            return back()->banner('Inventory matched to order items.');
        } else {
            $match->update([
                'quantity' => $match->matched_quantity,
            ]);

            return back()->banner('Inventory matched to order item, and the order item quantity was updated.');
        }
    }
}
