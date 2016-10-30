<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class TransactionsController extends Controller
{
    
    // initial landing function for the transactions
    public function index () {
        $companies = \App\Companies::pluck('name', 'symbol');
    	return view('transactions')->with('companies', $companies);
    }
    
}
