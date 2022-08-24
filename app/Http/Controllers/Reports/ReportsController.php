<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Show the index page with all reports.
     * 
     * 
     */
    public function index()
    {
        return \inertia('Reports/Index');
    }
}
