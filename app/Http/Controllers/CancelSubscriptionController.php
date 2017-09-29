<?php

namespace App\Http\Controllers;


class CancelSubscriptionController extends Controller
{
    public function __invoke($name)
    {
        auth()->user()->subscription($name)->cancel();
        confirm('Subscription has been cancelled');

        return redirect('/');
    }
}
