<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
require(app_path().'/DatabaseUtilities');

class TransactionsController extends Controller
{

    // initial landing function for the transactions
    public function index () {
        $companies = \App\Companies::pluck('name', 'symbol');
    	return view('transactions')->with('companies', $companies);
    }

    public function buy () {
        //TODO: Get code and number to sell
        //      update database holdings field
        //      update database balance
    }

    public function sell () {
        //TODO: Get code and number to sell
        //      update database holdings field
        //      update database balance
    }

}
