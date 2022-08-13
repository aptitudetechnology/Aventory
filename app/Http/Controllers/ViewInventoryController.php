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
        $productQuantities = $product->getAllSizeQuantities();
        $inventorySizes = $product->getAllInventorySizes();
        $inventory = $product->inventory;
        $priceLevels = $request->user()->price_levels;

        $product->append('base_prices');

        return inertia('View/Show', compact('product', 'productQuantities', 'inventorySizes', 'inventory', 'priceLevels'));
    }

    protected function getProducts()
    {
        return auth()->user()->currentTeam->products;
    }
}
