<?php

class ApiToken extends Eloquent {
	public $timestamps = false;

	public static function boot() {
		parent::boot();

		static::creating(function($token) {
			$token->token = static::getNewToken();
		});
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function updateToken() {
		$this->token = static::getNewToken();
	}

	private static function getNewToken() {
		return base64_encode(openssl_random_pseudo_bytes(48));
	}
}