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
        $inventorySizes = $product->inventorySizes()->withCount(['products' => function($query) use ($product) {
            $query->where('product_id', $product->id);
        }])->get();
         $inventory = $product->inventory;
        return inertia('View/Show', compact('products', 'product', 'inventorySizes', 'inventory'));
    }


    protected function getProducts()
    {
        return auth()->user()->currentTeam->products;
    }
}
