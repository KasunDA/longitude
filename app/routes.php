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
	'as' => 'index'));

Route::group(array('prefix' => 'users'), function() {

	Route::get('register', array('uses' => 'UserController@showRegistration',
		'as' => 'user.register'));

	Route::post('register', array('uses' => 'UserController@handleRegistration',
		'as' => 'user.register', 'before' => 'csrf'));

	Route::get('login', array('uses' => 'UserController@showLogin',
		'as' => 'user.login'));

	Route::post('login', array('uses' => 'UserController@handleLogin',
		'as' => 'user.login', 'before' => 'csrf'));

});
