<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('login', [
            'isLogin' => true
        ]);
    }

    public function viewRegister()
    {
        return view('register', [
            'isLogin' => true
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $rememberMe = $request->has('remember');

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validatedRequest = $request->validate([
            'username' => 'required|min:3|max:255|unique:users',
            'password' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users'
        ]);
        $repeatedpw = $request->repeatedpw;

        if ($validatedRequest['password'] !== $repeatedpw) {
            return redirect(route('register'))->withErrors('Password tidak sama!')->onlyInput('username', 'email');
        }

        $validatedRequest['password'] = bcrypt($validatedRequest['password']);

        $validatedRequest['role'] = 'user';

        // dd($validatedRequest);
        User::create($validatedRequest);

        return redirect(route('dashboard'))->with('success', 'Berhasil Terdaftar');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect(route('login'));
    }
}
