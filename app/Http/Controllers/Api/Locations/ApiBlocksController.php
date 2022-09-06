<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Models\NurseryLocation;

class ApiBlocksController extends Controller
{
    public function index(NurseryLocation $nursery)
    {
        $blocks = $nursery->blocks;

        return $blocks;
    }
}
