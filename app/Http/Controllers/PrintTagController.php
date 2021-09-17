<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemTagRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class PrintTagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(OrderItemTagRequest $request)
    {
        $inventories = Inventory::whereIn('block_id', $request->order_items)->get();

        return view('tags.index', compact('inventories'));
    }
}
