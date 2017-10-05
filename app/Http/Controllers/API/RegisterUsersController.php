<?php

namespace App\Http\Controllers\API;

use App\Events\UserHasRegistered;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\WelcomeEmail;
use Facades\App\Services\GoogleAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $user = User::create($request->only(['name','email','password']));
        $user->notify(new WelcomeEmail($user));
        Auth::guard('web')->login($user, true);
        event(new UserHasRegistered($user));
        GoogleAnalytics::trackEvent('users', 'new_user', $user->name);

        return response()->json(new UserResource($user));
    }
}