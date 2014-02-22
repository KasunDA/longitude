<?php

class UserController extends BaseController {

	public function showRegistration() {
		return View::make('register');
	}

	public function handleRegistration() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->user_type_id = 2;
			$user->save();
 
			return Redirect::route('user.login')
				->with('flash_message', 'Thanks for registering!')
				->with('flash_type', 'success');
		} else {
			return Redirect::route('user.register')
				->withErrors($validator)
				->withInput();
		}
	}

	public function showLogin() {
		$incorrectLogin = Session::has('incorrect_login');

		return View::make('login', array(
			'incorrectLogin' => $incorrectLogin
		));
	}

	public function handleLogin() {
		$userData = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if (Auth::attempt($userData)) {
			return Redirect::route('dashboard')
				->with('flash_message', 'You are now logged in!')
				->with('flash_type', 'success');
		} else {
			return Redirect::route('users.login')
				->with('incorrect_login', true)
				->withInput();
		}
	}

	public function handleLogout() {
		Auth::logout();
		return Redirect::route('index');
	}

}