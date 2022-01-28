<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseItemTagRequest;
use App\Models\Inventory;
use App\Models\PurchaseItem;
use PDF;

class PrintTagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PurchaseItemTagRequest $request)
    {
        $inventories = Inventory::whereIn('purchase_item_id', $request->purchase_items)->with('product.plant')->get();
        $team = auth()->user()->currentTeam;

        $paperSize = [0, 0, 288, 720];

        $tags = PDF::setOptions(['dpi' => 72, 'defaultFont' => 'sans-serif', 'isRemoteEnabled' => true])
            ->loadview('tags.index', compact('inventories', 'team'))
            ->setPaper($paperSize, 'landscape');

        PurchaseItem::whereIn('id', $request->purchase_items)->where('in_inventory', true)->update(['printed' => true]);
        // return view('tags.index', compact('inventories', 'team'));
        return $tags->stream('tags.pdf');
    }
}
