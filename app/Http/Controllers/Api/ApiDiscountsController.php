<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountStoreRequest;
use App\Models\Order;
use App\Models\OrderDiscount;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApiDiscountsController extends Controller
{
    public function index(Request $request, Order $order)
    {
        Gate::authorize('view', $order);
        $discounts = $order->discounts;
        return $discounts;
    }

    /**
     * Store a newly created discount in db.
     *
     * @param  DiscountStoreRequest  $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountStoreRequest $request, Order $order)
    {
        Gate::authorize('update', $order);
        $discount = $order->discounts()->create($request->validated());
        return $discount;
    }

    /**
     * Update the specified discount in db.
     *
     * @param  DiscountStoreRequest  $request
     * @param Order $order
     * @param  OrderDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountStoreRequest $request, Order $order, OrderDiscount $discount)
    {
        Gate::authorize('update', $order);
        $discount->update($request->validated());
        return redirect()->back();
    }
}
