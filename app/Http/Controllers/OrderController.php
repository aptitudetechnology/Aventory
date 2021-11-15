<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
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
            })->orderBy('id', 'desc')->paginate(10);

        return inertia('Orders/Index', ['orders' => $orders, 'filters' => $request->only(['search', 'orderBy'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->getCustomers();
        return inertia('Orders/Create', compact('customers'));
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
        return inertia('Orders/Show', compact('order', 'customers', 'orderItems'));
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
