<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewUserWasCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserAccountDetails;
use App\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->filled('q')) {
            $users = User::search(request('q'))
                         ->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        request()->flash();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = str_random(16);
        $user     = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($password),
        ]);
        $user->notify(new UserAccountDetails($password));
        event(new NewUserWasCreated($user));
        confirm('User account has been successfully created.');

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', [
            'user'  => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required|email']);
        $user->update($request->only(['name', 'email']));

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        $user->delete();
        confirm('User account has been successfully deleted.');

        return redirect('/admin/users');
    }
}
