<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// require_once(app_path().'\DatabaseUtilities.php');

class TransactionsController extends Controller
{

    // initial landing function for the transactions
    public function index () {
        $companies = \App\Companies::pluck('name', 'symbol');
    	return view('transactions')->with('companies', $companies);
    }

    public function buy (Request $request) {
        //TODO: Get code and number to sell
        //      update database holdings field

        $user = Auth::User();

        // //Updating the Users Holdings
        $holdings = array();
        updateHoldings($user->id, $holdings);

        // //Updating the Users Balance
        $total = 0;
        $newBalance = $user->balance - $total;
        updateBalance($user->id, $newBalance);
    }

    public function sell (Request $request) {
        //TODO: Get code and number to sell
        //      update database holdings field

        $user = Auth::User();

        // //Updating the Users Holdings
        $holdings = array();
        updateHoldings($user->id, $holdings);

        // //Updating the Users Balance
        $total = 0;
        $newBalance = $user->balance + $total;
        updateBalance($user->id, $newBalance);
    }

}
