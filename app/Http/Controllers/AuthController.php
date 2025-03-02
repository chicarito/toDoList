<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->validate(['username' => 'required', 'password' => 'required']);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin')->with('status', 'selamat datang ' . Auth::user()->name);
            } elseif (Auth::user()->role == 'tasker') {
                return redirect('/tasker')->with('status', 'selamat datang ' . Auth::user()->name);
            } else {
                return redirect('/worker')->with('status', 'selamat datang ' . Auth::user()->name);
            }
        }
        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
