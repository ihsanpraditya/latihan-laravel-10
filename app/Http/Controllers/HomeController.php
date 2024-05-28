<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
    public function users(){
	    $data = User::get();
        return view('users', compact('data'));
    }
    public function createUser(){
        return view('create');
    }
    public function storeUser(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        User::create([
            'email'     => $request->email,
            'name'      => $request->name,
            'password'  => Hash::make($request->password)
        ]);
        
        return redirect()->route('users');
    }
}