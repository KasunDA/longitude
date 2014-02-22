<?php

class Location extends Eloquent {
	public function user() {
		return $this->belongsTo('User');
	}
}