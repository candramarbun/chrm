<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
use Session;

class AuthController extends Controller
{
	public function getsignUpPage()
	{
		return view('auth.register');
	}


    public function getsignInPage()
    {
        return view('auth.login');
    }

    public function postSignUp(Request $request)
    {
    	$user =new User();
    	$user->first_name =$request['first_name'];
    	$user->last_name =$request['last_name'];
    	$user->email=$request['email'];
    	$user->password=bcrypt($request['password']);
    	$user->save();
    	$user->roles()->attach(Role::where('name','user')->first());
    	Auth::login($user);
        
    	return redirect()->route('adminindex');
    }

    public function postSignIn(Request $request)
    {
    	if (Auth::attempt([
            'email'=> $request->email, 
            'password'=> $request->password
            ]))
            {
    		return redirect()->route('project_index');
    	}

        Session::flash('flash_message', 'Gagal login, cek email dan password');
    	return redirect()->back();
    }

    public function getLogout()
    {
    	Auth::logout();
    	return redirect()->route('signIn');

    }
}

