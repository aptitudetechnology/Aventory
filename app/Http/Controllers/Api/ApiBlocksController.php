<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NurseryLocation;
use Illuminate\Http\Request;

class ApiBlocksController extends Controller
{
    public function index(NurseryLocation $nursery){
        $blocks = $nursery->blocks;
        return $blocks;
    }
}
