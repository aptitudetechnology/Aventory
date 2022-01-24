<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ReprintQueueController extends Controller
{
    public function index()
    {
        $queue = auth()->user()->currentTeam->reprintQueue()->where('printed', false)->get();

        return Inertia::render('ReprintQueue/Index', [
            'queue' => $queue,
        ]);
    }
}
