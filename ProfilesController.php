<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ProfilesController extends Controller
{
    
    
  public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($username){
        
        $user = $this->getUserByUsername($username);

		return view('profile');
    }
    
    public function update(Request $request)
    {
        $user = \App\User::find($id);
        $user->firstname = $firstname;
        $user->email= $email;
        $user->save();
        return view('profile');
    }
    
}


