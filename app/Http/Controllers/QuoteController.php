<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\PaymentStatus;
use App\Models\Quote;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quotes = auth()->user()->currentTeam->quotes()
            ->when($request->search, function ($query) use ($request) {
                $query->where('id', $request->search)->orWhereHas('customer', function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%");
                });
            })
            ->when($request->orderBy, function ($query) use ($request) {
                if ($request->orderBy == 'customer') {
                    $query->addSelect(['customer_name' => Customer::select('name')
                        ->whereColumn('id', 'orders.customer_id')])->orderBy('customer_name', $request->orderByDirection);
                } else {
                    $query->orderBy($request->orderBy, $request->orderByDirection);
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->paginate(10)->withQueryString();


        $filters = $request->only(['search', 'orderBy', 'orderByDirection']);

        return inertia('Quotes/Index', compact('quotes', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = auth()->user()->currentTeam->customers()->get();
        $teamMembers = auth()->user()->currentTeam->users()->get();
        $priceLevels = auth()->user()->currentTeam->priceLevels()->get();
        return inertia('Quotes/Create', compact('customers', 'teamMembers', 'priceLevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        $quote = auth()->user()->currentTeam->quotes()->create($request->validated());
        $quote->customer()->associate(Customer::findOrFail($request->customer_id));
        $quote->save();
        return redirect()->route('quotes.show', $quote);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Quote $quote)
    {
        Gate::authorize('view', $quote);
        $customers = \auth()->user()->currentTeam->customers;
        $items = $quote->items;
        $teamMembers = auth()->user()->currentTeam->allUsers();
        $priceLevels = auth()->user()->currentTeam->priceLevels;
        $delivery_statuses = DeliveryStatus::all();
        $payment_statuses = PaymentStatus::all();
        $products = auth()->user()->currentTeam->products;
        $sizes = auth()->user()->currentTeam->sizes;
        $shipping_methods = ShippingMethod::all();
        return inertia('Quotes/Show', compact(
            [
                'quote',
                'customers',
                'priceLevels',
                'teamMembers',
                'items',
                'delivery_statuses',
                'payment_statuses',
                'products',
                'sizes',
                'shipping_methods'
            ]
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStoreRequest $request, Quote $quote)
    {

        Gate::authorize('update', $quote);
        $quote->update($request->validated());

        $quote->updateDiscounts();
        $quote->updateTotals();

        return back()->banner("Great work! Updated quote.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        Gate::authorize('delete', $quote);
        $quote->delete();
        return redirect()->route('quotes.index')->banner('Quote deleted successfully');
    }
}
