<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryPrintRequest;
use App\Models\Inventory;
use App\Models\ReprintQueue;
use Illuminate\Http\Request;
use PDF;

class PrintInventoryTagsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InventoryPrintRequest $request)
    {
        $inventories = Inventory::whereIn('id', $request->inventory)->with('product.plant', 'reprintQueue')->get();

        $team = auth()->user()->currentTeam;

        $paperSize = [0, 0, 288, 720];

        $tags = PDF::setOptions(['dpi' => 72, 'defaultFont' => 'sans-serif', 'isRemoteEnabled' => true])
            ->loadview('tags.index', compact('inventories', 'team'))
            ->setPaper($paperSize, 'landscape');

        ReprintQueue::whereIn('inventory_id', $request->inventory)->update(['printed' => true]);
        // return view('tags.index', compact('inventories', 'team'));
        return $tags->stream('tags.pdf');
    }
}
