<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ApiInventoryQuantitiesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @param  Size  $size
     * @return \Illuminate\Http\Response
     * Returns the inventory data for a product and size.
     */
    public function __invoke(Request $request, Product $product, Size $size)
    {
        $data = $product->getQuantities($size);

        return $data;
    }
}
