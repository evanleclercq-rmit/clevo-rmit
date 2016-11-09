<?php 
namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 
 use App\Http\Requests;
 use Auth;
 require(app_path().'/UserShares.php');

 class UserController extends Controller
 {
 	
     //
 	public function profile()
 	{
        $shareValue = calculateSharesValue(Auth::User()->id);
        $avgShareValue = calculateAvgShareValue();
 		return view('profile', array('user' => Auth::user()) )->with(compact('shareValue', $shareValue,'avgShareValue',$avgShareValue));
                
        

 	}
 }

