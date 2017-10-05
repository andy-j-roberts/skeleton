<?php

namespace App\Http\Controllers\API\Users;

use App\Events\UsersRolesWereUpdated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Role;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $user->roles()->syncWithoutDetaching($request->get('role_ids'));
        event(new UsersRolesWereUpdated($user));

        return response()->json(['message' => 'Role(s) have been added'], 200);
    }

    public function destroy(User $user, Role $role)
    {
        $this->authorize('update', $user);
        $user->roles()->detach($role->id);
        event(new UsersRolesWereUpdated($user));

        return response()->json(['message' => 'Role has been removed'], 204);
    }
}