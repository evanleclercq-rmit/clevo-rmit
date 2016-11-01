<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
require(app_path().'\DatabaseUtilities.php');

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
        $company = $request->input('symbol');
        echo ('Company:'.$company);
        $price = $request->input('sharePrice');
        echo ('<br>Price:'.$price);
        $numberPurchased = $request->input('numberOfSharesBuy');
        echo ('<br>Purchased:'.$numberPurchased);

        $user = Auth::User();
        echo ('<br>ID:'.$user->id);

        // // //Updating the Users Holdings
        // $holdings = array();
        // updateHoldings($id, $holdings);

        // // //Updating the Users Balance
        $total = $price * $numberPurchased;
        echo ('<br><br> Total:'.$total);
        // $newBalance = $user->balance - $total;
        // updateBalance($id, $newBalance);
    }

    public function sell (Request $request) {
        //TODO: Get code and number to sell
        //      update database holdings field

        $company = $request->input('companyName');
        echo ('Company:'.$company);
        $price = $request->input('sharePrice');
        echo ('<br>Price:'.$price);
        $numberPurchased = $request->input('numberOfSharesBuy');
        echo ('<br>Purchased:'.$numberPurchased);

        // // //Updating the Users Holdings
        // $holdings = array();
        // updateHoldings($user->id, $holdings);

        // // //Updating the Users Balance
        $total = $price * $numberPurchased;;
        // $newBalance = $user->balance + $total;
        // updateBalance($user->id, $newBalance);
    }

}
