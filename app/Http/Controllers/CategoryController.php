<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->getCategories();

        return inertia('Categories/Index', compact('categories'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = $this->getCategories();

        return inertia('Categories/Create', compact('categories'));
    }

    /**
     * @param  \App\Http\Requests\CategoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = auth()->user()->currentTeam->categories()->create($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('categories.index')->banner('New Category created! Yeah, good job!');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        Gate::authorize('view', $category);
        $categories = $this->getCategories();
        $sizes = $request->user()->currentTeam->sizes;

        return inertia('Categories/Show', compact('category', 'categories', 'sizes'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        return redirect(route('categories.show', $category));
    }

    /**
     * @param  \App\Http\Requests\CategoryUpdateRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('categories.show', $category)->banner('Woohoo, yes, you did it! Successfully saved category.');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        Gate::authorize('delete', $category);
        $category->delete();

        return redirect()->route('categories.index')->banner('Category was deleted!');
    }

    protected function getCategories()
    {
        return auth()->user()->currentTeam->categories;
    }
}
