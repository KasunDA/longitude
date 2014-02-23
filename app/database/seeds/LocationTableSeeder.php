<?php

class LocationTableSeeder extends Seeder {
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('locations')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		Location::create(array(
			'user_id'      => 1,
			'latitude'     => 54.916107,
			'longitude'    => 23.982489
		));

		Location::create(array(
			'user_id'      => 1,
			'latitude'     => 54.911765,
			'longitude'    => 23.968370
		));

		Location::create(array(
			'user_id'      => 1,
			'latitude'     => 54.912357,
			'longitude'    => 23.958800
		));

		Location::create(array(
			'user_id'      => 1,
			'latitude'     => 54.911518,
			'longitude'    => 23.938715
		));
	}
}