<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArchivedCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $customers = $request->user()->currentTeam->customers()->onlyTrashed()->get();

        return  inertia('Customers/Index', ['customers' => $customers]);
    }

    /**
     * Display the specified resource.
     *
     * @param    $customerId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $customerId)
    {
        $customer = Customer::withTrashed()->find($customerId);
        Gate::authorize('view', $customer);
        $customers = $request->user()->currentTeam->customers()->onlyTrashed()->get();

        return inertia('Customers/ArchivedShow', ['customer' => $customer, 'customers' => $customers]);
    }

    /**
     * Restore the specified resource.
     *
     * @param    $customerId
     * @return \Illuminate\Http\Response
     */
    public function store($customerId)
    {
        $customer = Customer::withTrashed()->find($customerId);
        Gate::authorize('update', $customer);
        $customer->restore();

        return redirect(route('customers.show', $customer->id))->banner('Successfully restored company.');
    }
}
