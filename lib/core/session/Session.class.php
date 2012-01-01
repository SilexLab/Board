<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Session {
	private static $Handler;
	
	/**
	 * Starts the session
	 */
	public static function Start(SessionHandler $Handler) {
		if(defined('CLASS_SESSION'))
			return false;
		define('CLASS_SESSION', 1);
		
		self::$Handler = $Handler;
		
		session_start();
	}
	
	/**
	 * Destroy the session
	 */
	public static function Destroy() {
		session_destroy();
	}
	
	/**
	 * Reads the content of a session, if the key is empty, false will return
	 */
	public static function Read($Key) {
		return(isset($_SESSION[$Key]) ? $_SESSION[$Key] : false);
	}
	
	/**
	 * Sets the content of a session key.
	 * It will return true if succeeded else false
	 */
	public static function Set($Key, $Value) {
		return ($_SESSION[$Key] = $Value) === true;
	}
	
	/**
	 * Removes content from a session based on the given key
	 * Returns true if succeeded else false
	 */
	public static function Remove($Key) {
		return (bool)session_unset($Key);
	}
	
	public static function Status() {
		//return session_status(); // PHP DEV Version function
	}
}
?>