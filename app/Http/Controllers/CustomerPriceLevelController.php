<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\CustomerPriceLevel;
use Illuminate\Http\Request;

class CustomerPriceLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceLevels = $this->getPriceLevels();
        return inertia('PriceLevels/Index', ['priceLevels' => $priceLevels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create', CustomerPriceLevel::class);
        $priceLevels = $this->getPriceLevels();
        return inertia('PriceLevels/Create', ['priceLevels' => $priceLevels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', CustomerPriceLevel::class);

        Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'percentage_more' => ['required', 'numeric'],
        ])->validateWithBag('createPriceLevel');

        $priceLevel = $request->user()->currentTeam->priceLevels()->create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'percentage_more' => $request->percentage_more,
            ]
        );
        return redirect(route('customer-price-levels.index'))->banner('Successfully added price level.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPriceLevel $customerPriceLevel)
    {
        Gate::authorize('view', $customerPriceLevel);

        $priceLevels = $this->getPriceLevels();
        return inertia('PriceLevels/Show', ['priceLevels' => $priceLevels, 'priceLevel' => $customerPriceLevel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerPriceLevel $customerPriceLevel)
    {
        return redirect(route('customer-price-levels.show', $customerPriceLevel->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerPriceLevel $customerPriceLevel)
    {
        Gate::authorize('update', $customerPriceLevel);

        Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'percentage_more' => ['required', 'numeric'],
        ])->validateWithBag('createPriceLevel');

        $customerPriceLevel->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'percentage_more' => $request->percentage_more,
            ]
        );
        return redirect(route('customer-price-levels.index'))->banner('Price level successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPriceLevel $customerPriceLevel)
    {
        Gate::authorize('delete', $customerPriceLevel);

        $customerPriceLevel->delete();
        return redirect(route('customer-price-levels.index'))->banner('Price level deleted.');
    }

    public function getPriceLevels()
    {
        return auth()->user()->currentTeam->priceLevels;
    }
}
