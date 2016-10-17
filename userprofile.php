<?php



users::resource('user', 'UsersController');

users::get('/{profile}', 'ProfilesController@show');

	