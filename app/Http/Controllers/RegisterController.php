<?php

namespace App\Http\Controllers;

use App\Events\UserHasRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        Auth::login($user, true);
        event(new UserHasRegistered($user));


        return redirect('/home');
    }
}