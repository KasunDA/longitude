<?php

class ProfileController extends BaseController {

	public function showProfile() {
		$tokens = Auth::user()->apiTokens;

		return View::make('profile', array(
			'apiTokens' => $tokens
		));
	}

}