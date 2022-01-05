<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderPDFController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Order $order)
    {
        $invoice = $order->generatePDF();

        return $invoice->stream();
    }
}
