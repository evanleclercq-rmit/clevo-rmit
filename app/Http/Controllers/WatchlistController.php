<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

require(app_path().'/Watchlist.php');


class WatchlistController extends Controller
{
    
 public function add(Request $request) {
        $symbol = $request->input('companySym');
        $name = $request->input('companyNm');

        if ($name==null){
            $name = "NAME NOT FOUND";
        }
        $user = Auth::User();
        updateWatchlist($user, $symbol, $name);
        return redirect('/transactions');
    }

     public function remove(Request $request) {
        $symbol = $request->input('companySym');
        $user = Auth::User();
        removeCompany($user, $symbol);
        return redirect('/dashboard');
    }

}