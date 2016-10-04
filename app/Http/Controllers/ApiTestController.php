<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiTestController extends Controller
{
    
    public function index () {
        
        return view('apitest/apitest');
        
    }
    
}
