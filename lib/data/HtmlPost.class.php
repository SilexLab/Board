<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * Handle $_POST stuff
 */
class HtmlPost {
	public static function Get($Key) {
		return isset($_POST[$Key]) ? $_POST[$Key] : false;
	}

	/*public static function Set($Key, $Value) {
		$_POST[$Key] = $Value;
	}*/

	public static function Del($Key) {
		$_POST[$Key] = null;
		unset($_POST[$Key]);
	}
}
