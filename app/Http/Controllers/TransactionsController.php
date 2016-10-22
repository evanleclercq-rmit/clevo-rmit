<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class TransactionsController extends Controller
{
    
    // initial landing function for the transactions
    public function index () {
        return view('transactions');
    }
    
}
