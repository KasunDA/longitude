<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public static $rules = array(
		'username'              => 'required|alpha|between:4,16|unique:users',
		'password'              => 'required|between:8,128|confirmed',
		'password_confirmation' => 'required'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Model associations
	 */
	public function userType() {
		return $this->belongsTo('UserType');
	}

	public function locations() {
		return $this->hasMany('Location');
	}

	public function apiTokens() {
		return $this->hasMany('ApiToken');
	}

	public function internalToken() {
		return $this->apiTokens()->where('internal', '=', true)->first();
	}

}