<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require(app_path().'/DatabaseUtilities.php');

class editProfileController extends Controller
{

	public function index () {
		return view('editProfile');
	}

	public function changeName (Request $request) {
		$name = $request->input('name');
		updateDBField (Auth::User()->id, 'name', $name);
	}

	public function changeEmail (Request $request) {
		$email = $request->input('email');
		updateDBField (Auth::User()->id, 'email', $email);		
	}

	public function changeCity (Request $request) {
		$city = $request->input('city');
		updateDBField (Auth::User()->id, 'city', $city);		
	}

	public function changeAge (Request $request) {
		$age = $request->input('age');
		updateDBField (Auth::User()->id, 'age', $age);
	}

	public function changePassword (Request $request) {
		$newPass = $request->input('newPass');
	}

}
