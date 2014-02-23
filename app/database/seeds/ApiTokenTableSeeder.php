<?php

class ApiTokenTableSeeder extends Seeder {
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('api_tokens')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		ApiToken::create(array(
			'user_id'  => 1,
			'internal' => true
		));

		ApiToken::create(array(
			'user_id'  => 1,
			'internal' => false
		));

		ApiToken::create(array(
			'user_id'  => 2,
			'internal' => true
		));

		ApiToken::create(array(
			'user_id'  => 2,
			'internal' => false
		));
	}
}