<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ViewInventoryController extends Controller
{
    public function index(Request $request) 
    {

        $products = $this->getProducts();

        return inertia('View/Index', compact('products'));
    }

    public function show(Request $request, Product $product) 
    {
        $products = $this->getProducts();

        return inertia('View/Show', compact('products', 'product'));
    }


    protected function getProducts()
    {
        return auth()->user()->currentTeam->products;
    }
}
