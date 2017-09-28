<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PlansController extends Controller
{

    public function index()
    {
        $plans = Plan::all();

        return view('admin.plans.index', [
            'monthly' => $plans->where('interval', 'month'),
            'annual'  => $plans->where('interval', 'year'),
        ]);
    }

    public function create()
    {
        return view('admin.plans.create', ['plan' => new Plan()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'stripe_id' => 'required',
            'name'      => 'required',
            'amount'    => 'required',
            'currency'  => 'required',
            'interval'  => 'required',
        ]);
        DB::beginTransaction();
        try {
            $plan = Plan::create($request->only(['stripe_id', 'name', 'amount', 'currency', 'interval']));
            $plan->syncWithStripe();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        confirm('Plan has been created.');

        return redirect('/admin/plans');
    }

    public function show(Plan $plan)
    {
        return view('admin.plans.show', ['plan' => $plan, 'subscriptions' => $plan->getSubscriptions()]);
    }

}
