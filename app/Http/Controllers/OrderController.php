<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\ShippingMethod;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $orders = auth()->user()->currentTeam->orders()
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

        return inertia('Orders/Index', compact('orders', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create', Order::class);
        $customers = $this->getCustomers();
        $teamMembers = auth()->user()->currentTeam->allUsers();
        return inertia('Orders/Create', compact('customers', 'teamMembers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        Gate::authorize('create', Order::class);

        $order = auth()->user()->orders()->create($request->validated());

        $order->setTaxPercentage();

        return redirect()->route('orders.show', $order)->banner('Great work! Created order. Now add some products you sold.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        Gate::authorize('view', $order);
        $customers = $this->getCustomers();
        $items = $order->items;
        $teamMembers = auth()->user()->currentTeam->allUsers();
        $priceLevels = auth()->user()->currentTeam->priceLevels;
        $delivery_statuses = DeliveryStatus::all();
        $payment_statuses = PaymentStatus::all();
        $products = auth()->user()->currentTeam->products;
        $sizes = auth()->user()->currentTeam->sizes;
        $shipping_methods = ShippingMethod::all();
        return inertia('Orders/Show', compact(
            [
                'order',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStoreRequest $request, Order $order)
    {

        Gate::authorize('update', $order);
        $order->update($request->validated());

        $order->updateDiscounts();
        $order->updateTotals();

        return back()->banner("Great work! Updated order.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete', $order);
        $order->delete();
        return redirect()->route('orders.index')->banner('Order deleted.');
    }

    protected function getCustomers()
    {
        return auth()->user()->customers;
    }
}
