<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

require(app_path().'/DatabaseUtilities.php');


class SettingsController extends Controller
{
    public function index () {
    	$users = \App\User::all()->pluck('name', 'id')->toArray();
    	if (Auth::user()->admin==true){
    		return view('admin')->with('users', $users);
    	}
    	else {
    		return view('settings');
    	}
    }

    public function deleteUser (Request $request) {
       	$id = $request->input('userID');
 		$user = \App\User::find($id);    
		$user->delete();
		return redirect()->route('settings');
}

    public function resetUser (Request $request) {
    	$id = $request->input('restID');
    	$user = \App\User::find($id);    
		updateDBField($user->id, 'holdings', null);
        updateDBField($user->id, 'watchlist', null);
		updateDBField($user->id, 'balance', 20000);
		return redirect()->route('settings');
}

    public function addAdmin (Request $request) {
        $id = $request->input('addAdminID');
        $user = \App\User::find($id);    
        updateDBField($user->id, 'admin', 1);
        return redirect()->route('settings');
}

   public function removeAdmin (Request $request) {
        $id = $request->input('removeAdminID');
        $user = \App\User::find($id);    
        updateDBField($user->id, 'admin', 0);
        return redirect()->route('settings');
}

    public function deleteCurrentUser() {
        $user = Auth::User();   
        $user->delete();
        return redirect()->route('login');
}

    public function clearWatchlist () {
        $user = Auth::User();    
        updateDBField($user->id, 'watchlist', null);
        return redirect()->route('settings');
}

}
