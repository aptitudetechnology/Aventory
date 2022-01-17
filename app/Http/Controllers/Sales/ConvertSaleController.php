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

        $sale->is_quote = !$sale->is_quote;
        $sale->save();

        return redirect()->route($sale->route, $sale->id);
    }
}
