<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function showRegister()
    {
        return view('signup');
    }
   
    public function onRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $register = new User();
        $register ->name = $request->name;
        $register ->email = $request->email;
        $register ->password =bcrypt($request->password);
        $register ->save();
        return redirect()->route('login.form')->with('success', 'User successfully registered!');
    }
    public function onLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        
        if (Auth::attempt($credentials)) {
          
            return redirect()->intended('/');
        }

        return back()->with('error', 'credentials not match.');
    }
    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
