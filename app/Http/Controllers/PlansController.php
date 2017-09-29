<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanCollection;
use App\Http\Resources\PlanResource;
use App\Plan;

class PlansController extends Controller
{
    public function index()
    {
        $plans = PlanResource::collection(Plan::all());

        return view('plans.index', ['plans' => $plans]);
    }
}
