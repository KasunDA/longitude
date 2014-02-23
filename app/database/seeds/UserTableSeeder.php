<?php

class UserTableSeeder extends Seeder {
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('users')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		User::create(array(
			'id'           => 1,
			'username'     => 'admin',
			'password'     => '$2a$10$e/hyp3AK/lCD8kaH8FZUg.90CifwL5T9XgVHICtfkiyKRdMetCsd2',
			'user_type_id' => 1
		));

		User::create(array(
			'id'           => 2,
			'username'     => 'notadmin',
			'password'     => '$2a$10$J7tVAS6/01VcIehRA/EWceUTwAofXUl3cxHWhoIFb/EFkkvIq8vGi',
			'user_type_id' => 2
		));
	}
}