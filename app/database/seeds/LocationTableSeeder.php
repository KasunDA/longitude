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

		Location::create(array(
			'user_id'      => 2,
			'latitude'     => 54.916535,
			'longitude'    => 23.954122
		));

		Location::create(array(
			'user_id'      => 2,
			'latitude'     => 54.912218,
			'longitude'    => 23.956161
		));

		Location::create(array(
			'user_id'      => 2,
			'latitude'     => 54.909332,
			'longitude'    => 23.955259
		));

		Location::create(array(
			'user_id'      => 2,
			'latitude'     => 54.906667,
			'longitude'    => 23.951397
		));
	}
}