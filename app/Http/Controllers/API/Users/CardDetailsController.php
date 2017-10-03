<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\CreditCardResource;

class CardDetailsController extends Controller
{
    public function index()
    {
        return new CreditCardResource(auth()->user());
    }

    public function update()
    {

    }
}