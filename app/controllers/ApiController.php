<?php

class ApiController extends BaseController {

	public function getLocations() {
		$locationArray = array();

		if (Auth::user()->user_type_id == 1) {
			$users = User::with('locations')->get();

			foreach ($users as $user) {
				$locationArray[$user->username] = $user->locations->toArray();
			}
		} else {
			$user = Auth::user();
			$locationArray[$user->username] = $user->locations->toArray();
		}

		return Response::json(['locations' => $locationArray]);
	}

}