<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class RolesController extends Controller
{
    public function __construct() {
        $this->middleware('can:manage-roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('role_id', 'asc')->paginate(10);;

        //return a view and pass in the above variable
        return view('roles/roles')->withUsers($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('roles.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->role()->associate($request->role);

        $user->save();

        //Set flash data with success message
        Session::flash('userRoleUpdateSuccess', '');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        //Set flash data with success message
        Session::flash('userDeleteSuccess', '');

        return redirect()->route('roles.index');
    }
}
