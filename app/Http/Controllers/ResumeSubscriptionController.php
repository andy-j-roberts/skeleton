<?php

namespace App\Http\Controllers;


class ResumeSubscriptionController extends Controller
{
    public function __invoke($name)
    {
        $user = auth()->user();
        if($user->subscription($name)->onGracePeriod()) {
            auth()->user()->subscription($name)->resume();
            confirm('Subscription has been resumed');
        } else {
            alert('Subscription can no longer be resumed');
        }

        return redirect('/home');
    }
}
