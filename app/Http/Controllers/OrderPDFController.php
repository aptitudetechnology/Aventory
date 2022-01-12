<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;


class OrderPDFController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Sale $sale)
    {
        $invoice = $sale->generatePDF($request->template ? $request->template : 'default');

        return $invoice->stream();
    }
}
