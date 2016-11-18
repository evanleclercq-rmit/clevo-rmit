<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PrivacyController extends Controller
{
    public function index () {
        return view('privacy');
    }
}
