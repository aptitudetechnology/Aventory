<?php

namespace App\Http\Controllers;

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
        $priceLevels = auth()->user()->currentTeam->priceLevels;
        return inertia('PriceLevels/Index', ['priceLevels' => $priceLevels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priceLevels = auth()->user()->currentTeam->priceLevels;
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
        $priceLevel = $request->user()->currentTeam->priceLevels()->create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'percentage_more' => $request->percentage_more,
            ]
        );
        return redirect(route('price-levels.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPriceLevel $customerPriceLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerPriceLevel $customerPriceLevel)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerPriceLevel  $customerPriceLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPriceLevel $customerPriceLevel)
    {
        //
    }
}
