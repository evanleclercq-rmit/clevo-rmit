<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends Controller
{
    
    // initial landing function for the dashboard
    public function index () {
        $users = \App\User::all()->pluck('name')->toArray();
        $companies = \App\Companies::pluck('name', 'symbol');
    	return view('dashboard')->with(compact('companies', $companies, 'users', $users));
    }
    
}
