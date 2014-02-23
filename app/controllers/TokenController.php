<?php

class TokenController extends BaseController {

	public function newToken() {
		Auth::user()->apiTokens()->save(new ApiToken());
		return Redirect::route('profile')
			->with('flash_message', 'Token successfully added')
			->with('flash_type', 'success');
	}

	public function revokeToken($id) {
		if (Auth::user()->apiTokens->contains($id)) {
			ApiToken::destroy($id);
			return Redirect::route('profile')
				->with('flash_message', 'Token successfully revoked')
				->with('flash_type', 'success');
		} else {
			return Redirect::route('profile')
				->with('flash_message', 'Failed to revoke the API token')
				->with('flash_type', 'error');
		}
	}

}