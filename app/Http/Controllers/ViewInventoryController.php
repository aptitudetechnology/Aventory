<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
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
        $inventorySizes = $product->inventorySizes($product)->get();
        $inventory = $product->inventory;
        $priceLevels = $request->user()->price_levels;
        return inertia('View/Show', compact('products', 'product', 'inventorySizes', 'inventory', 'priceLevels'));
    }


    protected function getProducts()
    {
        return auth()->user()->currentTeam->products;
    }
}
