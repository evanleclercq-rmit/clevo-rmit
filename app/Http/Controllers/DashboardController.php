<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    
    // initial landing function for the dashboard
    public function index () {
        $users = \App\User::all()->pluck('name')->toArray();
        $companies = \App\Companies::pluck('name', 'symbol');
		$currentString = Auth::User()->watchlist;
		$watchlist = $this->parseString($currentString);
		return view('dashboard')->with(compact('companies', $companies, 'users', $users, 'watchlist', $watchlist));
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
    
}
