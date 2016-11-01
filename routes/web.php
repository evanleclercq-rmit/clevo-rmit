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
	return redirect()->route('login');
});

#Profile
Auth::routes();
Route::get('profile', 'UserController@profile');
Route::get('/home', 'HomeController@index');
Route::get('/login', function () {
    return view ('login.blade.php');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // All routes that need a logged in user
	Route::any('/dashboard', 'DashboardController@index');
	Route::any('/transactions', 'TransactionsController@index');
    Route::post('/transactions/buy', 'TransactionsController@buy');
    Route::post('/transactions/sell', 'TransactionsController@sell');
	Route::any('/company', 'CompanyController@index');
});


Route::get('/apiRequest', 'ApiRequestController@index');



//Test Routes
Route::get('/transTest', function () {
    return view ('transTest');
});
//Route to the API Test page/
Route::get('/apitest', 'ApiTestController@index');