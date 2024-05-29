<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request; // has validate() method
use Illuminate\Support\Facades\Validator; // noneed to use this if we use the above method
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(){
        if(!Auth::check()){
            Alert::error('login dulu ya!');
            return redirect()->route('user.login');
        }
            return view('index');
    }
    public function users(){
	    $data = User::get();
        return view('users', compact('data'));
    }
    public function userCreate(){
        return view('create');
    }
    public function userStore(Request $request){
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
        
        return redirect()->route('users')->with('success', 'User created successfully!');
    }
    public function userEdit($id){
        $userEdit = User::find($id);
        return view('edit', compact('userEdit'));
    }
    public function userUpdate(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'nullable',
        ]);
        
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['email']     = $request->email;
        $data['name']      = $request->name;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::find($id)->update($data);
        return redirect()->route('users')->with('success', 'User updated successfully!');
    }
    public function userDelete($id){
        User::find($id)->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully!');
    }
}