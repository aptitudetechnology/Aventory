<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
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
        $customers = $request->user()->currentTeam->customers;
        return  inertia('Customers/Index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create(Request $request)
    {
        $customers = $request->user()->currentTeam->customers;
        return inertia('Customers/Create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'zip' => ['nullable', 'string'],
            'mailing_address' => ['nullable', 'string'],
            'mailing_city' => ['nullable', 'string'],
            'mailing_state' => ['nullable', 'string'],
            'mailing_zip' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ])->validateWithBag('createCustomer');

        $customer = $request->user()->currentTeam->customers()->create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'mailing_same_as_primary' => $request->mailing_same_as_primary,
                'notes' => $request->notes,
                'is_retail' => $request->is_retail,
                'no_auto_discount' => $request->no_auto_discount,
                'tax_percentage' => $request->tax_percentage,
                'discount_override' => $request->discount_override,
                'reseller_permit_on_file' =>  $request->reseller_permit_expiration ? true : false,
                'reseller_permit_expiration' => $request->reseller_permit_expiration,
            ]
        );
        if ($request->mailing_same_as_primary) {
            $customer->update(
                [
                    'mailing_address' => $request->address,
                    'mailing_city' => $request->city,
                    'mailing_state' => $request->state,
                    'mailing_zip' => $request->zip
                ]
            );
        } else {
            $customer->update([
                'mailing_address' => $request->mailing_address,
                'mailing_city' => $request->mailing_city,
                'mailing_state' => $request->mailing_state,
                'mailing_zip' => $request->mailing_zip
            ]);
        }
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
        $customers = $request->user()->currentTeam->customers;
        return inertia('Customers/Show', ['customer' => $customer, 'customers' => $customers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return redirect(route('customers.show', $customer->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'zip' => ['nullable', 'string'],
            'mailing_address' => ['nullable', 'string'],
            'mailing_city' => ['nullable', 'string'],
            'mailing_state' => ['nullable', 'string'],
            'mailing_zip' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ])->validateWithBag('updateCustomer');

        $customer->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'mailing_same_as_primary' => $request->mailing_same_as_primary,
                'notes' => $request->notes,
                'is_retail' => $request->is_retail,
                'no_auto_discount' => $request->no_auto_discount,
                'tax_percentage' => $request->tax_percentage,
                'discount_override' => $request->discount_override,
                'reseller_permit_on_file' =>  $request->reseller_permit_expiration ? true : false,
                'reseller_permit_expiration' => $request->reseller_permit_expiration,
            ]
        );
        if ($request->mailing_same_as_primary) {
            $customer->update(
                [
                    'mailing_address' => $request->address,
                    'mailing_city' => $request->city,
                    'mailing_state' => $request->state,
                    'mailing_zip' => $request->zip
                ]
            );
        } else {
            $customer->update([
                'mailing_address' => $request->mailing_address,
                'mailing_city' => $request->mailing_city,
                'mailing_state' => $request->mailing_state,
                'mailing_zip' => $request->mailing_zip
            ]);
        }
        $request->session()->flash('success', 'Yeah! Customer was updated.');
        return redirect(route('customers.show', $customer->id))->banner('Yeah! Successfully saved customer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
