<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUserId()
    {
        return auth()->id();
    }


    public function index()
    {
        $userdata = User::find($this->getUserId());
        return view('profileUser.profileIndex', [
            'user' => $userdata
        ]);
    }

    public function username(Request $request)
    {
        $userId = $this->getUserId();
        $validatedRequest = $request->validate([
            'username' => 'required|min:3|max:255|unique:users',
        ]);

        User::where('id', $userId)->update($validatedRequest);

        return redirect(route('profile'))->with('success', 'Username Berhasil Diubah');
    }

    public function email(Request $request)
    {
        $userId = $this->getUserId();
        $validatedRequest = $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        User::where('id', $userId)->update($validatedRequest);

        return redirect(route('profile'))->with('success', 'Email Berhasil Diubah');
    }

    public function password(Request $request)
    {
        $userId = $this->getUserId();

        $validatedRequest = $request->validate([
            'password' => 'required|min:3|max:255',
        ]);

        if ($validatedRequest['password'] !== $request->pass_repeat) {
            return redirect(route('profile.index'))->withErrors('Password isn\'t match!');
        }

        $validatedRequest['password'] = bcrypt($validatedRequest['password']);

        User::where('id', $userId)->update($validatedRequest);

        return redirect(route('profile'))->with('success', 'Password Berhasil Diubah');
    }
}
