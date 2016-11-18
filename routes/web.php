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
Route::get('/profile', 'UserController@profile')->name('profile');
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
	Route::any('/history', 'HistoryController@index');
  Route::any('/edit-profile', 'editProfileController@index');
  Route::post('/edit-profile/change-name', 'editProfileController@changeName');
  Route::post('/edit-profile/change-email', 'editProfileController@changeEmail');
  Route::post('/edit-profile/change-city', 'editProfileController@changeCity');
  Route::post('/edit-profile/change-age', 'editProfileController@changeAge');
  Route::post('/edit-profile/change-password', 'editProfileController@changePassword');
	Route::any('/sitemap', 'SitemapController@index');
  Route::any('/settings', 'SettingsController@index')->name('settings');
  Route::any('/settings/delete-current', 'SettingsController@deleteCurrentUser');
  Route::any('/settings/clear-watch', 'SettingsController@clearWatchlist');
  Route::any('/settings/admin/delete', 'SettingsController@deleteUser');
  Route::any('/settings/admin/reset', 'SettingsController@resetUser');
  Route::any('/settings/admin/add-admin', 'SettingsController@addAdmin');
  Route::any('/settings/admin/remove-admin', 'SettingsController@removeAdmin');


});

Route::get('/apiRequest', 'ApiRequestController@index');
Route::get('/chart', 'ChartController@index');
Route::post('/add', 'WatchlistController@add');
Route::post('/remove', 'WatchlistController@remove');


//Test Routes
Route::get('/transTest', function () {
    return view ('transTest');
});
Route::get('/transComplete', function () {
    return view ('transactionSummary');
});

Route::get ('/editTest', function () {
    return view ('editProfile');
});

