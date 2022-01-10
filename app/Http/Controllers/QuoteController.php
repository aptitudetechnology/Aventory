<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
                        ->whereColumn('id', 'quotes.customer_id')])->orderBy('customer_name', $request->orderByDirection);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
