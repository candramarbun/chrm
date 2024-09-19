<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
Use App\User;

class AdminController extends Controller
{
    public function listUser()
    {
        $users= User::All();

        return view('user.index',compact('users'));
    }

    public function assignRoles(Request $request)
    {
        $email = $request['email'];
        $user = User::where('email',$email)->first();
        $user->roles()->detach();
        if ($request['role_user']) {
             $user->roles()->attach(Role::where('name','user')->first());
        }

         if ($request['role_author']) {
             $user->roles()->attach(Role::where('name','author')->first());
        }

         if ($request['role_admin']) {
             $user->roles()->attach(Role::where('name','admin')->first());
        }
       
        return redirect()->back();
    }

    public function addForm() {
    	return view('user.create'); 
    }

    public function add(Request $request) {

    	$user =new User();
    	$user->first_name =$request['first_name'];
    	$user->last_name =$request['last_name'];
    	$user->email=$request['email'];
    	$user->password=bcrypt($request['password']);
    	$user->save();
    	$user->roles()->attach(Role::where('name','author')->first());
        
    	return redirect()->route('listUser');
    }

    public function deleteUser($id) {
    	$user = User::find($id);
    	$user->delete();

    	return redirect()->route('listUser');
    }
}
