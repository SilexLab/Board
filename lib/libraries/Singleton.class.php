<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

abstract class Singleton {
	public static function GetInstance() {
		if(!static::$Instance)
			static::$Instance = new static;
		return static::$Instance;
	}

	private function __clone() {} 

	protected function __construct() {}
}