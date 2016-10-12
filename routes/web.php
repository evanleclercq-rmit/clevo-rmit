<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/login', function () {
    return view ('login.blade.php');
});

Auth::routes();

//Route to the dashboard controller - lands at defualt view.
Route::any('/dashboard', 'DashboardController@index');

//Route to the API Test page/
Route::get('/apitest', 'ApiTestController@index');
