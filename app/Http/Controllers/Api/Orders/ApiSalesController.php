<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiSalesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('customer')) {
            $customer = $request->user()->currentTeam->customers()->find($request->customer);
            $orders = $customer->orders;
            $quotes = $customer->quotes;
        } else {
            $orders = $request->user()->currentTeam->orders;
            $quotes = $request->user()->currentTeam->quotes;
        }

        return response()->json([
            'orders' => $orders,
            'quotes' => $quotes,
        ]);
    }
}
