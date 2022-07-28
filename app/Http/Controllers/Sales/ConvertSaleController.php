<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Sale;
use Illuminate\Http\Request;
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

        $quote = Quote::find($sale->id);

        if ($request->has('items') && $sale->is_quote && count($request->items) > 0) {
            $sale = Sale::convert($sale, $request->items);
        } elseif ($sale->doesntHaveInventory()) {
            if ($sale->from_quote_id) {
                return \back()->dangerBanner('This order is already linked to a quote. Please delete this order and edit the quote instead.');
            }
            if ($quote && $quote->orders->count() > 0) {
                return \back()->dangerBanner('You cannot convert this quote because there are already orders linked to it.');
            }
            $sale = Sale::convert($sale, $sale->items);
        } else {
            return \back()->dangerBanner('This sale has inventory matched and cannot be converted to a quote. Please unmatch inventory before converting.');
        }

        return redirect()->route($sale->route, $sale->id)->banner("New $sale->type created from $saleType.");
    }
}
