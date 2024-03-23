<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getUserId()
    {
        return auth()->id();
    }


    public function index()
    {
        $userdata = User::find($this->getUserId());
        return view('profileUser.profileindex', [
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

        return redirect(route('profile'))->with('success', 'Username Successfully Updated');
    }

    public function email(Request $request)
    {
        $userId = $this->getUserId();
        $validatedRequest = $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        User::where('id', $userId)->update($validatedRequest);

        return redirect(route('profile'))->with('success', 'Email Successfully Updated');
    }

    public function password(Request $request)
    {
        $userId = $this->getUserId();

        $validatedRequest = $request->validate([
            'password' => 'required|min:3|max:255',
        ]);

        if ($validatedRequest['password'] !== $request->pass_repeat) {
            return redirect(route('profile'))->withErrors('Password isn\'t match!');
        }

        $validatedRequest['password'] = bcrypt($validatedRequest['password']);

        User::where('id', $userId)->update($validatedRequest);

        return redirect(route('profile'))->with('success', 'Password Successfully Updated');
    }

    public function upload(Request $request)
    {
        $userId = $this->getUserId();

        $request->validate([
            'avatar' => 'required|image|max:4096'
        ]);
        // dd($request);
        try {
            $path = $request->file('avatar')->store('avatars');
            User::where('id', $userId)->update(array("path_file" => $path));

            return redirect(route('profile'))->with('success', 'Photo Successfully Uploaded');            
        } catch (\Exception $e) {
            return redirect(route('profile'))->withErrors('Upload Photo Failed, Try Again.');            
        }
    }
}
