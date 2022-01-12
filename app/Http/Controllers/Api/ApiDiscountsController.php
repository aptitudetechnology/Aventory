<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountStoreRequest;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\Quote;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApiDiscountsController extends Controller
{
    public function index(Sale $sale)
    {
        Gate::authorize('view', $sale);
        $discounts = $sale->discounts;
        return $discounts;
    }

    /**
     * Store a newly created discount in db.
     *
     * @param  DiscountStoreRequest  $request
     * @param Order $sale
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountStoreRequest $request, Sale $sale)
    {
        Gate::authorize('update', $sale);
        $discount = $sale->discounts()->create($request->validated());
        return back()->banner('Discount added to order!');
    }

    /**
     * Update the specified discount in db.
     *
     * @param  DiscountStoreRequest  $request
     * @param Sale $sale
     * @param  OrderDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountStoreRequest $request, Sale $sale, OrderDiscount $discount)
    {
        Gate::authorize('update', $sale);
        $discount->update($request->validated());
        return redirect()->back()->banner('Discount updated!');
    }

    /**
     * Remove the specified discount from db.
     *
     * @param Request $request
     * @param Sale $sale
     * @param  OrderDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, OrderDiscount $discount)
    {
        Gate::authorize('update', $sale);
        $discount->delete();
        return redirect()->back()->banner('Discount deleted!');
    }
}
