<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrdersController extends Controller
{
    /**
     * Get orders for past 30 days. 
     * Formated in json.
     * Returns, the orders, count, and total in dollars of the past 30 days for a given team.
     * 
     * @return \Illuminate\Http\Response 
     */
    public function index(Request $request)
    {
        $orders = $request->user()->currentTeam
            ->orders()->where('created_at', '>=', now()->subDays(30))->get();

        $response = [
            'orders' => $orders,
            'count' => $orders->count(),
            'total_in_dollars' => "$" . number_format($orders->sum('grand_total'), 2),
            'message' => 'Orders retrieved successfully.',

        ];

        return response()->json($response, 200);
    }
}
