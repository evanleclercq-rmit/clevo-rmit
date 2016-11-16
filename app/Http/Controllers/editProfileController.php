<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
require(app_path().'/DatabaseUtilities.php');

class editProfileController extends Controller
{

	public function index () {
		return view('editProfile');
	}

	public function changeName (Request $request) {
		if (!$request->input('name') == "") {
			$name = $request->input('name');
			updateDBField (Auth::User()->id, 'name', $name);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changeEmail (Request $request) {
		if (!isempty ($request->input('email'))) {
			$email = $request->input('email');
			updateDBField (Auth::User()->id, 'email', $email);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changeCity (Request $request) {
		if (!isempty ($request->input('city'))) {
			$city = $request->input('city');
			updateDBField (Auth::User()->id, 'city', $city);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	public function changeAge (Request $request) {
		if (!isempty ($request->input('age'))) {
			$age = $request->input('age');
			updateDBField (Auth::User()->id, 'age', $age);
			return redirect()->route ('profile');
		} else {
			return redirect()->route ('profile');
		}
	}

	// public function changePassword (Request $request) {
	// 	$newPass = $request->input('newPass');



	// 	return redirect()->route ('profile');
	// }

}
