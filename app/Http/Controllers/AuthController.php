<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            if (Auth::user()->role==='admin'){
                return redirect()->intended('admin.dashboard');
            }
            return redirect()->route('landing');
        }
        return back()->withErrors([
            'email'=>'Email atau Password salah']);
    }
    public function formRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed'
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>'seniman',
            'status'=>true,
        ]);
        Auth::login($user);
        return redirect()->route('landing');
    }
    public function logout(Request $request)
    {
        //
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
