<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SitemapController extends Controller
{
    public function index () {
        return view('sitemap');
    }
}
