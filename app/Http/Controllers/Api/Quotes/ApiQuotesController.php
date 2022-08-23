<?php

namespace App\Http\Controllers\Api\Quotes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiQuotesController extends Controller
{
    /**
     * Get active quotes.
     * Formated in json.
     * Returns, the quotes, count, and total in dollars of active quotes for a given team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activeQuotes = $request->user()->currentTeam->activeQuotes;

        $response = [
            'quotes' => $activeQuotes,
            'count' => $activeQuotes->count(),
            'total_in_dollars' => "$" . number_format($activeQuotes->sum('grand_total'), 2),
            'message' => 'Quotes retrieved successfully.',
        ];

        return response()->json($response, 200);
    }
}
