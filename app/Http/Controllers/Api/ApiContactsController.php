<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class ApiContactsController extends Controller
{
    public function index(Customer $customer)
    {
        return $customer->contacts;
    }
}
