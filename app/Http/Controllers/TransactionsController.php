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
        //      Add transaction fees

        $companySymbol = $request->input('companySymbol');
        $companyName = $request->input('companyName');
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

        if (isset ($holdings[$companySymbol])) {
            // echo $holdings[$company];
            $holdings[$companySymbol] += $numberPurchased;
            // echo $holdings[$company];
        } else {
            $holdings[$companySymbol] = $numberPurchased;
        }

        // print_r($holdings);
        updateHoldings($user->id, $holdings);

        // // //Updating the Users Balance
        $total = $price * $numberPurchased;
        $fee = ($total * 0.01) + 50;
        // echo ('<br><br> Total:'.$total);
        $newBalance = $user->balance - ($total + $fee);
        updateBalance($user->id, $newBalance);

        $info = array (
                       'transaction'=>'Purchase',
                       'companySymbol'=>$companySymbol,
                       'companyName'=>$companyName,
                       'numberShares'=>$numberPurchased,
                       'price'=>$price,
                       'totalCost'=>$total,
                       'closeBalance'=>$newBalance,
                       'startBalance'=>$user->balance,
                       'fee'=>$fee
                       );

        return view ('transactionSummary', ['info'=>$info]);

    }

    public function sell (Request $request) {
        //TODO: Add transaction fees


        $user = Auth::User();

        $companySymbol = $request->input('companySymbolSell');
        $companyName = $request->input('companyNameSell');
        // echo ('Company:'.$company);
        $price = $request->input('sharePriceSell');
        // echo ('<br>Price:'.$price);
        $numberPurchased = $request->input('numberOfSharesSell');
        // echo ('<br>Sold:'.$numberPurchased);

        $holdings = getHoldings($user->id);

        // echo "<br><br>";
        // print_r($holdings);

        if ($numberPurchased < $holdings[$companySymbol]) {
            $holdings[$companySymbol] = $holdings[$companySymbol] - $numberPurchased;
        } else {
            unset ($holdings[$companySymbol]);
        }

        updateHoldings($user->id, $holdings);

        $total = $price * $numberPurchased;

        //Calculate fee of 0.25% of sale
        $fee = ($total * 0.0025) + 50;
        $newBalance = $user->balance + ($total - $fee);

        updateBalance($user->id, $newBalance);

        // // //Updating the Users Holdings
        // $holdings = array();
        // updateHoldings($user->id, $holdings);

        $info = array (
                       'transaction'=>'Sale',
                       'companySymbol'=>$companySymbol,
                       'companyName'=>$companyName,
                       'numberShares'=>$numberPurchased,
                       'price'=>$price,
                       'totalCost'=>$total,
                       'startBalance'=>$user->balance,
                       'closeBalance'=>$newBalance,
                       'fee'=>$fee
                       );

        return view ('transactionSummary', ['info'=>$info]);
    }

}
