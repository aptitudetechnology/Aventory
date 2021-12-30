<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryArchiveStoreRequest;
use App\Http\Requests\OrderInventoryStoreRequest;
use App\Models\Inventory;
use App\Models\InventoryArchive;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ApiOrderInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        Gate::authorize('update', $order);
        return $order->inventory();
    }

    /**
     * Endpoint that sees if an item is able to be added to the order.
     * If the item is not able to be added, it will return the reason why.
     * If the item is able to be added, it will return the inventory object.
     * if the item is not able to be automatically matched to an order item, it will return a list of items that may be able to be matched.(Same product, but not the same size.)
     * 
     */
    public function show(Request $request, Order $order, Inventory $inventory)
    {
        Gate::authorize('update', $order);
        $message = "";
        $orderItem = $order->getItemMatchedToInventory($inventory);
        $match = $order->getPerfectInventoryMatchForItem($inventory);
        $possibleItemMatches = $order->getPossibleInventoryItemMatches($inventory);
        if ($orderItem) {
            $message  = "Inventory #{$inventory->id} has already been added to the order. Only re-add this item if it is for another order line item. If it is for the same line item, just edit the quantity matched.";
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
    public function store(InventoryArchiveStoreRequest $request, Order $order)
    {
        $inventory = Inventory::findOrFail($request->input('inventory_id'));
        $items = $order->items;

        $match = $items->find($request->input('order_item_id'));

        if (!$match) {
            $match = $order->items()->create([
                'product_id' => $inventory->product_id,
                'size_id' => $inventory->size_id,
                'unit_price' => $inventory->product->getPrice($inventory->size, $order->customer),
                'original_quantity' => $request->input('quantity_removed'),
                'quantity' => $request->input('quantity_removed'),
            ]);
        }

        if (!$match->is_matched) {
            $match->archived()->create([
                'order_item_id' => $match->id,
                'inventory_id' => $inventory->id,
                'quantity_removed' => $request->input('quantity_removed'),
                'removed_by_id' => auth()->user()->id,
                'reason_removed' => 'Sold',
                'was_adjustment' => false,
            ]);
            return back()->banner('Inventory matched to order items.');
        } else {
            return back()->dangerBanner('This order item is already matched to inventory. Update quantity of the order item before matching more inventory.');
        }
    }
}
