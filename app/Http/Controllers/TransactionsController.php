<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
require(app_path().'/DatabaseUtilities.php');

class TransactionsController extends Controller
{

    // initial landing function for the transactions
    public function index () {
        $companies = \App\Companies::pluck('name', 'symbol');
    	return view('transactions')->with('companies', $companies);
    }

    public function buy (Request $request) {
        //TODO: Hash the data

        $company = $request->input('companyName');
        // echo ('Company:'.$company);
        $price = $request->input('sharePrice');
        // echo ('<br>Price:'.$price);
        $numberPurchased = $request->input('numberOfSharesBuy');
        // echo ('<br>Purchased:'.$numberPurchased);

        $user = Auth::User();
        // echo ('<br>ID:'.$user->id);

        // // //Updating the Users Holdings
        $holdings = getHoldings($user->id);
        // print_r ($holdings);

        if (isset ($holdings[$company])) {
            // echo $holdings[$company];
            $holdings[$company] += $numberPurchased;
            // echo $holdings[$company];
        } else {
            $holdings[$company] = $numberPurchased;
        }

        // print_r($holdings);
        updateHoldings($user->id, $holdings);

        // // //Updating the Users Balance
        $total = $price * $numberPurchased;
        // echo ('<br><br> Total:'.$total);
        $newBalance = $user->balance - $total;
        updateBalance($user->id, $newBalance);

        $info = array (
                       'transaction'=>'Purchase',
                       'company'=>$company,
                       'numberShares'=>$numberPurchased,
                       'price'=>$price,
                       'totalCost'=>$total,
                       'closeBalance'=>$newBalance,
                       'startBalance'=>$user->balance
                       );

        return view ('transactionSummary', ['info'=>$info]);

    }

    public function sell (Request $request) {
        //TODO: Get code and number to sell
        //      update database holdings field
        $user = Auth::User();

        $company = $request->input('companyNameSell');
        echo ('Company:'.$company);
        $price = $request->input('sharePriceSell');
        echo ('<br>Price:'.$price);
        $numberPurchased = $request->input('numberOfSharesSell');
        echo ('<br>Sold:'.$numberPurchased);

        $holdings = getHoldings($user->id);

        echo "<br><br>";
        print_r($holdings);

        if ($numberPurchased < $holdings[$company]) {
            $holdings[$company] = $holdings[$company] - $numberPurchased;
        } else {
            unset ($holdings[$company]);
        }

        updateHoldings($user->id, $holdings);

        $total = $price * $numberPurchased;
        $newBalance = $user->balance + $total;

        updateBalance($user->id, $newBalance);

        // // //Updating the Users Holdings
        // $holdings = array();
        // updateHoldings($user->id, $holdings);

        $info = array (
                       'transaction'=>'Sale',
                       'company'=>$company,
                       'numberShares'=>$numberPurchased,
                       'price'=>$price,
                       'totalCost'=>$total,
                       'startBalance'=>$user->balance,
                       'closeBalance'=>$newBalance
                       );

        return view ('transactionSummary', ['info'=>$info]);
    }

}
