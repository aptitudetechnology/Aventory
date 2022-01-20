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
        $saleType = $sale->type;
        Gate::authorize('update', $sale);

        $request->validate([
            'items' => 'nullable|array',
        ]);

        if ($request->has('items') && $sale->is_quote && count($request->items) > 0) {
            $sale = Sale::convert($sale, $request->items);
        } else if ($sale->doesntHaveInventory()) {
            $sale->is_quote = !$sale->is_quote;
            $sale->save();
            $sale->updateTotals();
        } else {
            return \back()->dangerBanner("This sale has inventory matched and cannot be converted to a quote. Please unmatch inventory before converting.");
        }

        return redirect()->route($sale->route, $sale->id)->banner("$saleType converted successfully to $sale->type.");
    }
}
