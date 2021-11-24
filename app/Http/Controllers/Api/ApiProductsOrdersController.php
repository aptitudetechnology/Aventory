<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductsOrdersController extends Controller
{
    public function index(Product $product)
    {
        $onHold = $product->activeQuotesOnHold()->get();
        $sold = $product->pendingOrders()->get();
        return response()->json([
            'on_hold' => $onHold,
            'sold' => $sold,
        ]);
    }
}
