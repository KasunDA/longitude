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

Route::get('users/register', array('uses' => 'UserController@showRegistration',
	'as' => 'user.register'));

Route::post('users/create', array('uses' => 'UserController@handleRegistration',
	'as' => 'user.create'));
