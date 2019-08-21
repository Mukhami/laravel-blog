<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function showedit(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::where('id', '=', $user_id)->firstOrFail();
        return view("admin.profile_form", compact('user'));
    }

    public function editinfo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|max:255|unique:users'
        ]);

        $user_id = $request->get('id');
        $name = $request->get('name');
        $email = $request->get('email');

        $user = User::find($user_id);
        $user->name = $name;
        $user->email = $email;


        $user->save();

        return redirect('author')->with('info', 'You details have been changed successfully');
    }
}
