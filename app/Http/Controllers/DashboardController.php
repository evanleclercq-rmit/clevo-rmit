<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

require(app_path().'/UserShares.php');

class DashboardController extends Controller
{
    
    // initial landing function for the dashboard
    public function index () {
        $shareValue = calculateSharesValue(Auth::User()->id);
        $leaders = $this->getLeaders();
        $companies = \App\Companies::pluck('name', 'symbol');
		$currentString = Auth::User()->watchlist;
		$watchlist = $this->parseString($currentString);
		return view('dashboard')->with(compact('companies', $companies, 'leaders', $leaders, 'watchlist', $watchlist, 'shareValue', $shareValue));
    }

    	// Parse string 
		 public function parseString($data)
		{
		    $data = preg_replace_callback('/(?:^|(?<=&))[^=[]+/', function($match) {
		        return bin2hex(urldecode($match[0]));
		    }, $data);
		    parse_str($data, $values);

		    return array_combine(array_map('hex2bin', array_keys($values)), $values);
		}

	public function getLeaders () {
    	$ids = \App\User::all()->pluck('id')->toArray();
	    $names = \App\User::all()->pluck('name')->toArray();
	    $balances = \App\User::all()->pluck('balance')->toArray();
	    $leaders = array();
	    for ( $i = 0; $i < sizeof($ids); $i++){
	       		$id = $ids[$i];
	       		$name = $names[$i];
	       		$balance = $balances[$i];
	       	    $shareValue = calculateSharesValue($id);
	       	    $totalValue = $balance + $shareValue;
	       	    $newUser = array();
	       	    array_push($newUser, $name, $totalValue);
	       	    array_push($leaders, $newUser);
        }
		   
		    usort($leaders, function($a, $b) {
		    return $b[1] - $a[1] ;
		});
       return $leaders;
    }

}
