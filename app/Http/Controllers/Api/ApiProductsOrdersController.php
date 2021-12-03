<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductsOrdersController extends Controller
{
    public function index(Product $product)
    {
        $onHold = $product->activeQuotesOnHold()->with('items')->get();
        $sold = $product->pendingOrders()->with('items')->get();
        return response()->json([
            'on_hold' => $onHold,
            'sold' => $sold,
        ]);
    }
}
