<?php

class TokenController extends BaseController {

	public function refreshToken($id) {
		$token = Auth::user()->apiTokens()->find($id);

		if ($token->internal !== TRUE) {
			$token->updateToken();
			$token->save();

			return Redirect::route('profile')
				->with('flash_message', 'Token successfully updated')
				->with('flash_type', 'success');
		} else {
			return Redirect::route('profile')
				->with('flash_message', 'Invalid token specified')
				->with('flash_type', 'error');
		}
	}

}