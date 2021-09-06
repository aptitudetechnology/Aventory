<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->getOrders();

        return inertia('Orders/Index', compact('orders'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Order::class);
        $orders = $this->getOrders();
        $vendors = $this->getVendors();
        return inertia('Orders/Create', compact('orders', 'vendors'));
    }

    /**
     * @param \App\Http\Requests\OrderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        Gate::authorize('create', Order::class);

        $order = $request->user()->currentTeam->orders()->create($request->validated());

        $request->session()->flash('order.id', $order->id);

        return redirect()->route('orders.show', $order)->banner('Great! Created order. Now add order items.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        Gate::authorize('view', $order);

        $orders = $this->getOrders();
        $vendors = $this->getVendors();

        return inertia('Orders/Show', compact('orders', 'vendors', 'order'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Order $order)
    {
        return redirect()->route('orders.show', $order);
    }

    /**
     * @param \App\Http\Requests\OrderUpdateRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        Gate::authorize('update', $order);

        $order->update($request->validated());

        $request->session()->flash('order.id', $order->id);

        return redirect()->route('orders.show', $order)->banner('Updated order!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        Gate::authorize('delete', $order);
        $order->delete();

        return redirect()->route('orders.index')->banner('Deleted Order!');
    }

    protected function getOrders()
    {
        return auth()->user()->currentTeam->orders;
    }

    protected function getVendors()
    {
        return auth()->user()->currentTeam->vendors;
    }
}
