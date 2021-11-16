<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class ApiContactsController extends Controller
{
    public function index(Customer $customer)
    {
        return $customer->contacts;
    }
}
