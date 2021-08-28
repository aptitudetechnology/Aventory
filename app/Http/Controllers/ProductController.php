<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->getProducts();
        return inertia('Products/Index', compact('products'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Contact::class);

        $products = $this->getProducts();
        $categories = $this->getCategories();
        return inertia('Products/Create', compact('products', 'categories'));
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = auth()->user()->currentTeam->products()->create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'type' => $request->type
        ]);

        if ($request->type == "plant") {
            $product->plant()->create([
                'scientific_name' => $request->scientific_name,
                'common_name' => $request->common_name,
                'zone' => $request->zone,
                'height' => $request->height,
                'spread' => $request->spread,
                'bloom_color' => $request->bloom_color,
                'fall_color' => $request->fall_color,
                'growth_rate' => $request->growth_rate
            ]);
        }

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.show', $product)->banner('Saved product successfully.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        Gate::authorize('view', $product);

        $products = $this->getProducts();
        $categories = $this->getCategories();
        return inertia('Products/Show', compact('product', 'products', 'categories'));
    }


    /**
     * @param \App\Http\Requests\ProductUpdateRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'type' => $request->type
        ]);
        if ($product->type == "plant") {
            $product->plant()->update([
                'scientific_name' => $request->scientific_name,
                'common_name' => $request->common_name,
                'zone' => $request->zone,
                'height' => $request->height,
                'spread' => $request->spread,
                'bloom_color' => $request->bloom_color,
                'fall_color' => $request->fall_color,
                'growth_rate' => $request->growth_rate
            ]);
        }


        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.show', $product)->banner('Saved changes to product successfully.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')->banner('Deleted Product.');
    }

    protected function getProducts()
    {
        return auth()->user()->currentTeam->products;
    }

    protected function getCategories()
    {
        return auth()->user()->currentTeam->categories;
    }
}
