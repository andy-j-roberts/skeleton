<?php

namespace App\Http\Controllers;


class ResumeSubscriptionController extends Controller
{
    public function __invoke($name)
    {
        $user = auth()->user();
        if($user->subscription('main')->onGracePeriod()) {
            auth()->user()->subscription('main')->resume();
        } else {
            alert('Subscription can no longer be resumed');
        }

        return response()->json(['status' => 'OK'], 200);
    }
}
