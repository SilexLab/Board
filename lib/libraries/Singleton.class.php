<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Singleton {
	// Store class instance
	private static $Instance;

	// A private constructor; prevents direct creation of object
	protected function __construct() {}

	// Get Instance
	public static function GetInstance() {
		if(!static::$Instance)
			static::$Instance = new static;
		return static::$Instance;
	}
	 
	// Prevent users to clone the instance
	private function __clone(){
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
}
