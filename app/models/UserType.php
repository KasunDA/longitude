<?php

class UserType extends Eloquent {
	public $timestamps = false;

	public function users() {
		return $this->hasMany('User');
	}
}