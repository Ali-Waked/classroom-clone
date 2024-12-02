<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __invoke()
    {
        return view('plan', [
            'plans' => Plan::with('features')->get(),
        ]);
    }
}
