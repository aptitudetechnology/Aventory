<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArchivedVendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $vendors = $request->user()->currentTeam->vendors()->onlyTrashed()->get();

        return  inertia('Vendors/Index', ['vendors' => $vendors]);
    }

    /**
     * Display the specified resource.
     *
     * @param    $vendorId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $vendorId)
    {
        $vendor = Vendor::withTrashed()->find($vendorId);
        Gate::authorize('view', $vendor);
        $vendors = $request->user()->currentTeam->vendors()->onlyTrashed()->get();

        return inertia('Vendors/ArchivedShow', ['vendor' => $vendor, 'vendors' => $vendors]);
    }

    /**
     * Restore the specified resource.
     *
     * @param    $vendorId
     * @return \Illuminate\Http\Response
     */
    public function store($vendorId)
    {
        $vendor = Vendor::withTrashed()->find($vendorId);
        Gate::authorize('update', $vendor);
        $vendor->restore();

        return redirect(route('vendors.show', $vendor->id))->banner('Successfully restored company.');
    }
}
