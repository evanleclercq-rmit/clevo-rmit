<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HistoricController extends Controller
{
    
    public function index () {
        
        return view('historic');
        
    }
    
}
