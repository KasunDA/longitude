<?php

class UserController extends BaseController {

	public function showRegistration() {
		$user = new User();
		return View::make('register', array(
			'user' => $user
		));
	}

	public function handleRegistration() {

	}

}