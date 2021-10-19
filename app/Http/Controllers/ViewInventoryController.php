<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewInventoryController extends Controller
{
    public function index(Request $request) 
    {
        return inertia('View/Index');
    }
}
