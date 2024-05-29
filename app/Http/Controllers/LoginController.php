<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function userLogin(){
        return view('login');
    }
    public function userLoginProcess(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)){
            return redirect()->route('user.login')->with('success', 'Login gagal!');
        }
        return redirect()->route('home');
    }
    public function userLogout(){
        return redirect()->route('userLogin')->with('success', 'Berhasil logout!');
    }
}