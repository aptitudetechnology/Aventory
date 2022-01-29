<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReprintQueueController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'orderBy', 'orderByDirection', 'includePrinted']);

        $queue = auth()->user()->currentTeam
            ->inventoryToReprint()
            ->when($request->includePrinted, function ($query) use ($filters) {
                return $query
                    ->where('printed', $filters['includePrinted']);
            }, function ($query) {
                return $query->where('printed', false);
            })
            ->when($request->orderBy, function ($query) use ($request) {
                if ($request->orderBy == 'product') {
                    $query
                        ->addSelect(['product_name' => Product::select('name')
                            ->whereColumn('id', 'reprint_queue.inventory.product_id')])
                        ->orderBy('product_name', $request->orderByDirection);
                } else {
                    $query->orderBy($request->orderBy, $request->orderByDirection);
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->paginate(10)->withQueryString();


        return Inertia::render('ReprintQueue/Index', [
            'queue' => $queue,
            'filters' => $filters,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $team = auth()->user()->currentTeam;
        $inventory = $team->inventories()->findOrFail($request->inventory);


        $team->reprintQueue()->updateOrCreate(
            [
                'inventory_id' => $inventory->id,
            ],
            [
                'to_print' => $request->quantity,
                'printed' => false,
                'created_at' => now(),
            ]

        );

        return redirect()->back()->banner('Inventory added to reprint queue');
    }
}
