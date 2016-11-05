<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

require(app_path().'\DatabaseUtilities.php');

class HistoryController extends Controller
{
    
    // initial landing function for the dashboard
    public function index () {
     
    return view('history');
}
}
