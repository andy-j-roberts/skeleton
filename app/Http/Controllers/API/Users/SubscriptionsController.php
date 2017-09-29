<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;

class SubscriptionsController extends Controller
{
    public function __invoke()
    {
        return SubscriptionResource::collection(auth()->user()->subscriptions);
    }
}