<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $customers = $this->getCustomers();

        return  inertia('Customers/Index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create(Request $request)
    {
        $customers = $this->getCustomers();
        $priceLevels = $this->getPriceLevels();
        return inertia('Customers/Create', [
            'customers' => $customers,
            'priceLevels' => $priceLevels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $request->user()
            ->currentTeam->customers()
            ->create($request->validated());

        $this->updateMailingAddress($customer, $request);

        return redirect(route('customers.show', $customer->id))->banner('Successfully saved new customer.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        Gate::authorize('view', $customer);
        $customers = $this->getCustomers();

        $priceLevels = $this->getPriceLevels();
        $priceLevel = $customer->priceLevel;

        return inertia('Customers/Show', [
            'customer' => $customer,
            'customers' => $customers,
            'priceLevels' => $priceLevels,
            'priceLevel' => $priceLevel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        Gate::authorize('update', $customer);
        return redirect(route('customers.show', $customer->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        $this->updateMailingAddress($customer, $request);

        $request->session()->flash('success', 'Yeah! Customer was updated.');
        return redirect(route('customers.show', $customer->id))->banner('Yeah! Successfully saved customer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $customerId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Gate::authorize('delete', $customer);
        $customer->delete();
        session()->flash('flash.banner', 'The customer was deleted');
        session()->flash('flash.bannerStyle', 'danger');
        return redirect(route('customers.index'));
    }

    public function getCustomers()
    {
        return auth()->user()->currentTeam->customers;
    }

    public function getPriceLevels()
    {
        return auth()->user()->currentTeam->priceLevels;
    }

    public function updateMailingAddress($customer, $request)
    {
        if ($request->mailing_same_as_primary) {
            $customer->update(
                [
                    'mailing_address' => $request->address,
                    'mailing_city' => $request->city,
                    'mailing_state' => $request->state,
                    'mailing_zip' => $request->zip
                ]
            );
        }
    }
}
