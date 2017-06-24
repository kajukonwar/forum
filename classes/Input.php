<?php

class Input {

	/**
	 * Check if the form has been submitted
	 * @param string form method
	 * @param string submit button name
	 * @return boolean true/false
	 */
	public static function exists($type="post",$submit_btn) {
		switch($type) {

			case 'post':

				return ($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST[$submit_btn]))?true:false;
					
				break;

			case 'get':

				return ($_SERVER["REQUEST_METHOD"]=="GET"&&isset($_GET[$submit_btn]))?true:false;
				break;

			default:

				return false;
		}
	}


	/**
	 * fetches the submitted form data
	 * @param string input name
	 * @return string input value or empty string
	 */

	public static function get($item) {

		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else if(isset($_GET[$item])) {
			return $_GET[$item];
		}

		return '';

	}
}//end class
