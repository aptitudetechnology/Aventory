<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BasePriceStoreRequest;
use App\Models\BasePrice;

class BasePriceController extends Controller
{
    /**
     * @param \App\Http\Requests\BasePriceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasePriceStoreRequest $request)
    {
        $baseprice = BasePrice::create($request->validated());

        $request->session()->flash('baseprice.id', $baseprice->id);

        return redirect()->route('products.show', $baseprice->product_id)->banner('New product price created! Yeah, good job!');
    }
}
