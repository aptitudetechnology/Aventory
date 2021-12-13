<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApiDiscountsController extends Controller
{
    public function index(Request $request, Order $order)
    {
        Gate::authorize('view', $order);
        $discounts = $order->discounts;
        return $discounts;
    }
}
