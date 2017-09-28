<?php

namespace App\Http\Controllers\Admin\Stripe;

use App\Http\Controllers\Controller;
use App\Plan;
use Stripe\Stripe;
use Stripe\Plan as StripePlan;

class SyncPlansController extends Controller
{
    public function __invoke()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $plans = StripePlan::all();
        foreach ($plans->data as $stripePlan) {
            $plan = Plan::firstOrCreate(['stripe_id' => $stripePlan->id]);
            $plan->update([
                'name'   => $stripePlan->name,
                'amount' => $stripePlan->amount,
                'interval' => $stripePlan->interval,
                'currency' => $stripePlan->currency,
                'metadata' => $stripePlan->metadata,
            ]);
        }
        confirm('Plans have been updated.');

        return redirect('/admin/plans');
    }
}
