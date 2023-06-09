<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ApiProductsOrdersController extends Controller
{
    public function index(Product $product)
    {
        $onHold = $product->itemsOnHold()->select('product_id', 'quantity', 'order_id', 'size_id')->get();
        $inventorySold = $product->itemsSold()->select('product_id', 'order_id', 'size_id', 'quantity')->get();

        return response()->json(compact('onHold', 'inventorySold'));
    }
}
