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
            ->reprintQueue()
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
            'inventory' => 'required|array',
            'inventory.*' => 'required|exists:inventories,id',
        ]);

        $inventories = auth()->user()->currentTeam->inventories()->whereIn('id', $request->inventory)->get();

        $inventories->each(function ($inventory) {
            $inventory->reprintQueue()->create();
        });

        return redirect()->back()->banner('Inventory added to reprint queue');
    }
}
