<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorStoreRequest;
use App\Http\Requests\VendorUpdateRequest;
use App\Models\Vendor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $vendors = $this->getVendors();

        return  inertia('Vendors/Index', ['vendors' => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create(Request $request)
    {
        $vendors = $this->getVendors();
        $priceLevels = $this->getPriceLevels();
        return inertia('Vendors/Create', [
            'vendors' => $vendors,
            'priceLevels' => $priceLevels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorStoreRequest $request)
    {
        $vendor = $request->user()
            ->currentTeam->vendors()
            ->create($request->validated());

        $this->updateMailingAddress($vendor, $request);

        return redirect(route('vendors.show', $vendor->id))->banner('Successfully saved new vendor.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Vendor $vendor)
    {
        Gate::authorize('view', $vendor);
        $vendors = $this->getvendors();

        $priceLevels = $this->getPriceLevels();
        $priceLevel = $vendor->priceLevel;

        return inertia('Vendors/Show', [
            'vendor' => $vendor,
            'vendors' => $vendors,
            'priceLevels' => $priceLevels,
            'priceLevel' => $priceLevel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        Gate::authorize('update', $vendor);
        return redirect(route('vendors.show', $vendor->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(VendorUpdateRequest $request, Vendor $vendor)
    {
        $vendor->update($request->validated());

        $this->updateMailingAddress($vendor, $request);

        $request->session()->flash('success', 'Yeah! Vendor was updated.');
        return redirect(route('vendors.show', $vendor->id))->banner('Yeah! Successfully saved vendor.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $vendorId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        Gate::authorize('delete', $vendor);
        $vendor->delete();
        session()->flash('flash.banner', 'The vendor was deleted');
        session()->flash('flash.bannerStyle', 'danger');
        return redirect(route('vendors.index'));
    }

    public function getVendors()
    {
        return auth()->user()->currentTeam->vendors;
    }

    public function getPriceLevels()
    {
        return auth()->user()->currentTeam->priceLevels;
    }

    public function updateMailingAddress($vendor, $request)
    {
        if ($request->mailing_same_as_primary) {
            $vendor->update(
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
