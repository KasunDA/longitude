<?php

class UserTableSeeder extends Seeder {
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('users')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$user = User::create(array(
			'id'           => 1,
			'username'     => 'admin',
			'password'     => '$2a$04$BxXsZLfneByzlNzfKuN2PewrNQPa.jK4yafgLsnl48PRAY.61UH.2',
			'user_type_id' => 1
		));
	}
}