<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceStoreRequest;
use App\Http\Requests\PriceUpdateRequest;
use App\Models\Price;
use Illuminate\Support\Facades\Gate;

class PriceController extends Controller
{
    /**
     * @param  \App\Http\Requests\PriceStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceStoreRequest $request)
    {
        Gate::authorize('create', Price::class);
        $price = Price::create($request->validated());

        $request->session()->flash('baseprice.id', $price->id);

        return redirect()->back()->banner('New product price created! Yeah, good job!');
    }

    /**
     * @param  \App\Http\Requests\PriceUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PriceUpdateRequest $request, Price $price)
    {
        Gate::authorize('update', $price);
        $price->update($request->validated());

        $request->session()->flash('baseprice.id', $price->id);

        return redirect()->back()->banner('Updated Price!');
    }

    /**
     * @param  \App\Http\Requests\PriceUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        Gate::authorize('delete', $price);
        $price->delete();

        return redirect()->back()->banner('Removed Price!');
    }
}
