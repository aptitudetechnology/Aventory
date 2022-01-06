<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductSizesController extends Controller
{
    /**
     * Return the sizes of a product
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return $product->allSizes;
    }
}
