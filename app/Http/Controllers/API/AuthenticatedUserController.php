<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AuthenticatedUserController extends Controller
{
    public function __invoke()
    {
        return new UserResource(auth()->user());
    }
}