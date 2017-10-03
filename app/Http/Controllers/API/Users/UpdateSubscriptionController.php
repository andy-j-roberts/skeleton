<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateSubscriptionController extends Controller
{
    public function update(Request $request)
    {
        auth()->user()->subscription('main')->swap($request->get('stripe_id'));

        return response()->json(['status' => 'OK'], 200);
    }
}
