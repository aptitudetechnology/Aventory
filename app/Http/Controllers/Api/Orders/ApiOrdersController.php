<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrdersController extends Controller
{
    /**
     * Get orders for past 30 days.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('created_at', '>=', now()->subDays(30))->get();
        return response()->json($orders);
    }
}
