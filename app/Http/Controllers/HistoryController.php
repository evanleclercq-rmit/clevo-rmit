<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transaction; 
use Illuminate\Support\Facades\Auth;

require(app_path().'/DatabaseUtilities.php');

class HistoryController extends Controller
{
    
    public function index () {
    $history = \App\Transaction::where('name', Auth::User()->name)->get();
    return view('history')->with('history', $history);
	}
}
