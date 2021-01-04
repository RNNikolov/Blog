<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $user = User::find($id);

        $this->authorize('userCheck', $user->profile);

        return view('profile.edit')->withUser($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        //Validate the data
        $this->validate($request, array(
            'bio' => 'required|string|max:25',
            'age' => 'required|integer',
        ));

        //Save the data to the database
        $user->profile->fill($request->all());

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->getClientOriginalName();
            $fileName = pathinfo($avatar, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('avatar')->move(public_path('images'), $fileName);

            $user->profile->image->url = asset('images/'.$fileName);
        }

        $user->profile->image()->save($user->profile->image);
        $user->profile->save();


        //Set flash data with success message
        Session::flash('profileUpdateSuccess', '');

        //Redirect with flash data to the show request
        return back();

    }
}
