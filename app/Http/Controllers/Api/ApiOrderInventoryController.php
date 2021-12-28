<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderInventoryStoreRequest;
use App\Models\Inventory;
use App\Models\Order;
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
    public function show(Order $order, Inventory $inventory)
    {
        Gate::authorize('update', $order);
        $message = "";
        $orderItem = $order->getItemMatchedToInventory($inventory);
        $match = $order->getInventoryItemMatch($inventory);
        $possibleItemMatches = $order->getPossibleInventoryItemMatches($inventory);
        if ($orderItem) {
            $message  = 'This item is already added to the order.';
            $match = null;
        } elseif ($match) {
            $message = '';
        } elseif ($possibleItemMatches->count() > 0) {
            $message = "Please select an item to match to the order.";
        } else {
            $message = "No items found that match the scanned item.";
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
     * @param  \Illuminate\Http\Requests\OrderInventoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderInventoryStoreRequest $request, Order $order)
    {
        $inventory = Inventory::findOrFail($request->input('inventory_id'));
        $items = $order->items;

        $match = $items->where('product_id', $inventory->product_id)->where('size_id', $inventory->size_id)->first();

        if (!$match) {
            $match = $order->items()->create([
                'product_id' => $inventory->product_id,
                'size_id' => $inventory->size_id,
                'unit_price' => $inventory->product->prices->where('size_id', $inventory->size_id)->first()->getPriceForLevel($order->customer->priceLevel),
                'original_quantity' => $request->input('quantity'),
                'quantity' => $request->input('quantity'),
            ]);
        }

        $match->inventory()->attach($inventory->id, ['quantity_removed' => $request->input('quantity')]);

        $inventory->update([
            'quantity' => $inventory->quantity - $request->input('quantity'),
        ]);

        return back()->banner('Inventory matched to order items.');
    }
}
