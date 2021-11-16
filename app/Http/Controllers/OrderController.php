<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;

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
            ->paginate(10);
        return inertia('Orders/Index', ['orders' => $orders, 'filters' => $request->only(['search', 'orderBy', 'orderByDirection'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $order = auth()->user()->orders()->create($request->validated());

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
        $customers = $this->getCustomers();
        $orderItems = $order->orderItems;
        $delivery_statuses = DeliveryStatus::all();
        $payment_statuses = PaymentStatus::all();
        return inertia('Orders/Show', compact('order', 'customers', 'orderItems', 'delivery_statuses', 'payment_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    protected function getCustomers()
    {
        return auth()->user()->customers;
    }
}
