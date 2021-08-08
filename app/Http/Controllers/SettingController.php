<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function profile($id)
    {
        $user = User::find($id);
        return view('settings.profile', compact('user'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|min:4|max:64',
            'email' => 'required|min:2|email|unique:users,email,'.$user->id
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        $user->update($data);

        return redirect()->route('profile', $user->id)->with('success', 'Profile Updated Successfully!');
    }

    public function changePassword()
    {
        return view('settings.changePassword');
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password']
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back()->with('success', 'Password Updated Successfully!');
    }
}
