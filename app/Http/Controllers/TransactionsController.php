<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Transaction; 

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

        if (isset ($holdings[$companyName])) {
            // echo $holdings[$company];
            $holdings[$companyName][1] += $numberPurchased;
            // echo $holdings[$company];
        } else {
            $holdings[$companyName][0] = $companySymbol;
            $holdings[$companyName][1] = $numberPurchased;
        }

        // print_r($holdings);
        updateHoldings($user->id, $holdings);

        // // //Updating the Users Balance
        $shareValue = $price * $numberPurchased;
        $fee = ($shareValue * 0.01) + 50;
        $total = $shareValue + $fee;
        // echo ('<br><br> Total:'.$total);
        $newBalance = $user->balance - ($total + $fee);
        updateBalance($user->id, $newBalance);
        $info = array (
                       'transaction'=>'Purchase',
                       'companySymbol'=>$companySymbol,
                       'companyName'=>$companyName,
                       'numberShares'=>$numberPurchased,
                       'price'=>number_format((float)$price, 2, '.', ''),
                       'shareValue'=>number_format((float)$shareValue, 2, '.', ''),
                      'totalCost'=>number_format((float)$total, 2, '.', ''),
                       'closeBalance'=>number_format((float)$newBalance, 2, '.', ''),
                       'startBalance'=>number_format((float)$user->balance, 2, '.', ''),
                       'fee'=>number_format((float)$fee, 2, '.', ''),
                       );
       $this->createHistory($info);
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

        $shareValue = $price * $numberPurchased;
        //Calculate fee of 0.25% of sale
        $fee = ($shareValue * 0.0025) + 50;
        $total = $shareValue - $fee;

        $newBalance = $user->balance + ($shareValue - $fee);

        updateBalance($user->id, $newBalance);
        // // //Updating the Users Holdings
        // $holdings = array();
        // updateHoldings($user->id, $holdings);

        $info = array (
                       'transaction'=>'Sale',
                      'companySymbol'=>$companySymbol,
                       'companyName'=>$companyName,
                       'numberShares'=>$numberPurchased,
                       'price'=>number_format((float)$price, 2, '.', ''),
                       'shareValue'=>number_format((float)$shareValue, 2, '.', ''),
                        'totalCost'=>number_format((float)$total, 2, '.', ''),
                       'closeBalance'=>number_format((float)$newBalance, 2, '.', ''),
                       'startBalance'=>number_format((float)$user->balance, 2, '.', ''),
                       'fee'=>number_format((float)$fee, 2, '.', ''),
                       );

       $this->createHistory($info);
        return view ('transactionSummary', ['info'=>$info]);
    } 
 
   public function createHistory($info){

            $user = Auth::User();
            $date = date('d-m-Y');
           
           Transaction::create([
            'name' => $user->name,
            'number' => $info['numberShares'],
            'price' => $info['price'],
            'total' => $info['totalCost'],
            'date' => $date,
            'symbol' => $info['companySymbol'],
            'type' => $info['transaction'],


        ]);



    }


}
