<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SBB {
	// Objects
	private static $Database, $Config;
	
	/**
	 * Returns the config value
	 * @param	string	$Node
	 */
	public static final function Config($Node) {
		if(!self::$Config)
			self::$Config = new Config();
		return self::$Config->Get($Node);
	}
	
	/**
	 * Returns the database object
	 */
	public static final function DB() {
		if(!self::$Database)
			self::$Database = Database::GetDatabase();
		return self::$Database;
	}
	
	/**
	 * Handles uncatched exceptions and calls the Show method in the given cases
	 * @param	Exception	$e
	 */
	public static final function ExceptionHandler(Exception $e) {
		if($e instanceof PrintableException) {
			$e->Show();
			exit;
		}
		echo $e;
	}
}
?>