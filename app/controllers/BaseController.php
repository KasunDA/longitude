<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Return a JSON success with the specified message
	 * Example: {"success":"message"}
	 * 
	 * @param $message - a string with the message to return
	 * @return the JSON response
	 */
	protected function jsonSuccess($message) {
		$error['success'] = $message;
		return json_encode($error);
	}

	/**
	 * Return a JSON error with the specified message
	 * Example: {"error":"message"}
	 * 
	 * @param $message - a string with the message to return
	 * @return the JSON response
	 */
	protected function jsonError($message) {
		$error['error'] = $message;
		return json_encode($error);
	}

}