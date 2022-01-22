<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Gate;

class ConvertSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function convert(Request $request, Sale $sale)
    {
        Gate::authorize('update', $sale);

        $request->validate([
            'items' => 'nullable|array',
        ]);

        $saleType = $sale->type;


        if ($request->has('items') && $sale->is_quote && count($request->items) > 0) {
            $sale = Sale::convert($sale, $request->items);
        } else if ($sale->doesntHaveInventory()) {
            if ($sale->from_quote_id) {
                return \back()->dangerBanner("This order is already linked to a quote. Please delete this order and edit the quote instead.");
            }
            $sale = Sale::convert($sale, $sale->items);
        } else {
            return \back()->dangerBanner("This sale has inventory matched and cannot be converted to a quote. Please unmatch inventory before converting.");
        }

        return redirect()->route($sale->route, $sale->id)->banner("New $sale->type created from $saleType.");
    }
}
