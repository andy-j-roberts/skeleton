<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribeToPlanController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $user->newSubscription($request->get('stripe_id'),
            $request->get('stripe_id'))->create($request->get('stripeToken'), [
            'email' => $user->email,
        ]);
        confirm('You have successfully subscribed.');

        return redirect('/home');
    }
}
