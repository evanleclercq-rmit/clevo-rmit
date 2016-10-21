<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends Controller
{
    
    // initial landing function for the dashboard
    public function index () {
        return view('dashboard');
    }
    
}
