<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemTagRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PDF;

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
        $inventories = Inventory::whereIn('order_item_id', $request->order_items)->with('product.plant')->get();
        $team = auth()->user()->currentTeam;
        $paperSize = [0, 0, 288, 720];
        $tags = PDF::setOptions(['dpi' => 72, 'defaultFont' => 'sans-serif'])
            ->loadview('tags.index', compact('inventories', 'team'))
            ->setPaper($paperSize, 'landscape');
        Storage::disk('public')->put('tags/' . $team->id . '-' . Carbon::now() . '.pdf', $tags->output());
    }
}
