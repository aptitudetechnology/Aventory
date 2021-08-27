<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Product;

class ArchivedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $products = $this->getArchivedProducts();

        return  inertia('Products/Index', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param   $productId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $productId)
    {
        $product = Product::withTrashed()->find($productId);
        Gate::authorize('view', $product);

        $products = $this->getArchivedProducts();

        return inertia('Products/ArchivedShow', ['product' => $product, 'products' => $products]);
    }

    /**
     * Restore the specified resource.
     *
     * @param  $productId
     * @return \Illuminate\Http\Response
     */
    public function store($productId)
    {
        $product = Product::withTrashed()->find($productId);
        Gate::authorize('update', $product);
        $product->restore();
        return redirect(route('products.show', $product->id))->banner('Successfully restored company.');
    }

    public function getArchivedProducts()
    {
        return auth()->user()->currentTeam->products()->onlyTrashed()->get();
    }
}
