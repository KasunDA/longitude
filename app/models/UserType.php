<?php

class UserType extends Eloquent {
	public function users() {
		return $this->hasMany('User');
	}
}