<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Session {
	/**
	 * Initial session use
	 */
	public static function Start(MySQLi $MySQLi) {
		if(defined('CLASS_SESSION'))
			return false;
		define('CLASS_SESSION', '');
		
		// Session preparation
		ini_set('session.gc_maxlifetime', SBB::Config('config.user.autologout'));
		ini_set('session.gc_probability', SBB::Config('config.user.extra.autologout_probability'));
		ini_set('session.gc_divisor', 100);
		ini_set('session.save_handler', 'user');
		session_set_save_handler(
			array(new self, 'hOpen'),
			array(new self, 'hClose'),
			array(new self, 'hRead'),
			array(new self, 'hWrite'),
			array(new self, 'hDestroy'),
			array(new self, 'hGC')
		);
		// Start the session
		session_start();
		
		register_shutdown_function('session_write_close');
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
		return ($_SESSION[$Key] = $Value) === true ? true : false;
	}
	
	/**
	 * Removes content from a session based on the given key
	 * Returns true if succeeded else false
	 */
	public static function Remove($Key) {
		return session_unset($Key) ? true : false;
	}
	
	public static function Status() {
		//return session_status(); // PHP DEV Version function
	}
	
// session_set_save_handler functions
	
	public static function hOpen($Path, $Name) {
		return true;
	}
	public static function hClose() {
		return true;
	}
	public static function hRead($SessionID) {
		if(SBB::SQL()->Table('session')->Select('SessionValue')->Where('`ID` = \''.SBB::SQL()->RealEscapeString($SessionID).'\'')->Execute() !== false)
			return SBB::SQL()->FetchObject()->SessionValue;
		return '';
	}
	public static function hWrite($SessionID, $Data) {
		return SBB::SQL()->Table('session')->Replace(
			array(
				'ID' => SBB::SQL()->RealEscapeString($SessionID),
				'SessionValue' => SBB::SQL()->RealEscapeString($Data),
				'UserID' => User::GetUserID(), // TODO: Need this value!!
				'IPAddress' => $_SERVER['REMOTE_ADDR'],
				'UserAgent' => SBB::SQL()->RealEscapeString($_SERVER['HTTP_USER_AGENT']),
				'LastActivityTime' => time(),
				'Token' => sha1(md5(mt_rand()).microtime().mt_rand())
			))->Execute() ? true : false;
	}
	public static function hDestroy($SessionID) {
		return SBB::SQL()->Table('session')->Delete()->Where('`ID` = \''.SBB::SQL()->RealEscapeString($SessionID).'\'')->Execute() ? true : false;
	}
	public static function hGC($MaxLife) {
		return SBB::SQL()->Table('session')->Delete()->Where('`LastActivityTime` < '.time() - $MaxLife)->Execute() ? true : false;
	}
}