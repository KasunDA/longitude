<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@showIndex',
	'as' => 'index', 'before' => 'guest'));

Route::get('dashboard', array('uses' => 'DashboardController@showDashboard',
	'as' => 'dashboard', 'before' => 'auth'));

Route::get('profile', array('uses' => 'ProfileController@showProfile',
	'as' => 'profile', 'before' => 'auth'));

Route::group(array('prefix' => 'users'), function() {

	Route::get('register', array('uses' => 'UserController@showRegistration',
		'as' => 'user.register', 'before' => 'guest'));

	Route::post('register', array('uses' => 'UserController@handleRegistration',
		'as' => 'user.register', 'before' => 'csrf'));

	Route::get('login', array('uses' => 'UserController@showLogin',
		'as' => 'user.login', 'before' => 'guest'));

	Route::post('login', array('uses' => 'UserController@handleLogin',
		'as' => 'user.login', 'before' => 'csrf'));

	Route::get('logout', array('uses' => 'UserController@handleLogout',
		'as' => 'user.logout'));

});

Route::group(array('prefix' => 'api', 'before' => 'auth'), function() {

	Route::get('locations', array('uses' => 'ApiController@getLocations',
		'as' => 'api.locations'));

});

Route::group(array('prefix' => 'tokens'), function() {

	Route::get('new', array('uses' => 'TokenController@newToken',
		'as' => 'token.new', 'before' => 'auth'));

	Route::get('revoke/{id}', array('uses' => 'TokenController@revokeToken',
		'as' => 'token.revoke', 'before' => 'auth'));

});
