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
        $order->discounts()->create($request->validated());
        return back()->banner('Discount added to order!');
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
        return redirect()->back()->banner('Discount updated!');
    }

    /**
     * Remove the specified discount from db.
     *
     * @param Request $request
     * @param Order $order
     * @param  OrderDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order, OrderDiscount $discount)
    {
        Gate::authorize('update', $order);
        $discount->delete();
        return redirect()->back()->banner('Discount deleted!');
    }
}
