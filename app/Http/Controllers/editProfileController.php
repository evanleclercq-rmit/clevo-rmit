<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
require(app_path().'/DatabaseUtilities.php');

class editProfileController extends Controller
{	

	public function index () {
		return view('editProfile');
	}

	public function changeName (Request $request) {
			$this->validate($request, [
            'name' => 'required|max:255|regex:/^[a-zA-Z0-9].*$/',
    ]);
		if (!$request->input('name') == "") {
			$name = $request->input('name');
			updateDBField (Auth::User()->id, 'name', $name);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changeEmail (Request $request) {
			$this->validate($request, [
           'email' => 'required|email|max:255|unique:users',
    ]);
		if (!$request->input('email') == "") {
			$email = $request->input('email');
			updateDBField (Auth::User()->id, 'email', $email);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changeCity (Request $request) {
			$this->validate($request, [
            'city' => 'max:255|regex:/^[a-zA-Z0-9].*$/',
    ]);
		if (!$request->input('city') == "") {
			$city = $request->input('city');
			updateDBField (Auth::User()->id, 'city', $city);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changeAge (Request $request) {
		$ageRules = array('numeric', 'max:100', 'regex:/^.*(?:[1-9]\d{2,}+|[2-9]\d|1[89]).*$/');
		$this->validate($request, [
            'age' => $ageRules, 
    ]);
		if (!$request->input('age') == "") {
			$age = $request->input('age');
			updateDBField (Auth::User()->id, 'age', $age);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changePassword (Request $request) {
			$this->validate($request, [
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/|confirmed',
    ]);
		if ($request->input('newPass') != "" && $request->input('confirmPass') != "" && $request->input('currentPass') != "") {
			$newPass = $request->input('newPass');
			$confirmPass = $request->input('confirmPass');
			if (Hash::check($request->input('currentPass'), Auth::User()->password)) {
				if ($newPass == $confirmPass) {
					updateDBField (Auth::User()->id, 'password', bcrypt ($newPass));
					echo ($this->alertResult('Password Changed Successfully'));
					echo ("<script>window.location.href='".url ('/profile')."';</script>");
					// return redirect()->route ('profile');
				} else {
					echo ($this->alertResult('Password Could Not Be Changed: New Passwords Did Not Match'));
					echo ("<script>window.location.href='".url ('/profile')."';</script>");
					// return redirect()->route ('profile');
				}			
			} else {
				echo ($this->alertResult('Password Could Not Be Changed: Current Password Not Correct'));
				echo ("<script>window.location.href='".url ('/profile')."';</script>");
				// return redirect()->route ('profile');
			}
		} else {
			echo ($this->alertResult('Password Could Not Be Changed'));
			echo ("<script>window.location.href='".url ('/profile')."';</script>");
			// return redirect()->route ('profile');
		}

	}


    public function alertResult ($msg) {
    	return ("<script>window.alert ('" . $msg . "')</script>");
    }

}


