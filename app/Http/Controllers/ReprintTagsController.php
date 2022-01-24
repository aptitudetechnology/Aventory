<?php

namespace App\Http\Controllers;

use App\Models\ReprintQueue;
use Illuminate\Http\Request;

class ReprintTagsController extends Controller
{
    public function index()
    {
        $queue = auth()->user()->currentTeam->reprintQueue()->where('printed', false)->get();
        return $queue;
    }
}
