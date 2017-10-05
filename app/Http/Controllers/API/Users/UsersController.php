<?php

namespace App\Http\Controllers\API\Users;

use App\Events\NewUserWasCreated;
use App\Events\UserHasBeenDeleted;
use App\Events\UserHasBeenUpdated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserAccountDetails;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        $password = str_random(16);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);
        $user->notify(new UserAccountDetails($password));
        event(new NewUserWasCreated($user));

        return response()->json(['message' => 'User account has been successfully created.'], 201);
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $request->validate([
            'name'  => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ]
        ]);
        $user->update($request->only(['name', 'email']));
        event(new UserHasBeenUpdated($user));

        return response()->json(['message' => 'User has been updated successfully'], 200);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        event(new UserHasBeenDeleted($user));

        return response()->json(['message' => 'User has been deleted successfully'], 204);
    }
}