<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GettingStartedController extends Controller
{
    public function index () {
        return view('gettingStarted');
    }
}
