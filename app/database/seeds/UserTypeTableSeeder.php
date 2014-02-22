<?php

class UserTypeTableSeeder extends Seeder {
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('user_types')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		UserType::create(array(
			'id' => 1,
			'name' => 'admin'
		));

		UserType::create(array(
			'id' => 2,
			'name' => 'user'
		));
	}
}