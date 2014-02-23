<?php

class ApiToken extends Eloquent {
	public $timestamps = false;

	public static function boot() {
		parent::boot();

		static::creating(function($token) {
			$token->token = base64_encode(openssl_random_pseudo_bytes(48));
		});
	}

	public function user() {
		return $this->belongsTo('User');
	}
}