<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PriceStoreRequest;
use App\Http\Requests\PriceUpdateRequest;
use App\Models\Price;

class PriceController extends Controller
{
    /**
     * @param \App\Http\Requests\PriceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceStoreRequest $request)
    {
        $price = Price::create($request->validated());

        $request->session()->flash('baseprice.id', $price->id);
        return redirect()->back()->banner('New product price created! Yeah, good job!');
    }

    /**
     * @param \App\Http\Requests\PriceUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(PriceUpdateRequest $request, Price $price)
    {
        $price->update($request->validated());

        $request->session()->flash('baseprice.id', $price->id);

        return redirect()->route('products.show', $price->product)->banner('Updated Price!');
    }
}
