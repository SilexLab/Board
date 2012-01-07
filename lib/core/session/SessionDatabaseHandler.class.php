<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SessionDatabaseHandler extends SessionHandler implements Singleton {
	private static $Instance = NULL;
	
	public static function GetInstance() {
		if(!self::$Instance)
			self::$Instance = new self;
		return self::$Instance;
	}
	
	private function __clone() {}
	
	protected function __construct() {	
		// Session configuration
		ini_set('session.save_handler', 'user');
		ini_set('session.gc_maxlifetime', SBB::Config('config.user.autologout'));
		ini_set('session.gc_probability', SBB::Config('config.user.session.autologout_probability'));
		ini_set('session.gc_divisor', 100);
		ini_set('session.hash_function', 1);
		
		register_shutdown_function('session_write_close');
		
		session_name(SBB::Config('config.user.session.name'));
		session_set_cookie_params(SBB::Config('config.user.session.cookie_time'), NULL, NULL, NULL, true);
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);
	}
	
	public function open($Path, $Name) {
		return true;
	}
	
	public function close() {
		return true;
	}
	
	public function read($SessionID) {
		$Result = SBB::DB()->Query('SELECT * FROM `session` WHERE `ID` = \''.$SessionID.'\' LIMIT 1;')->Execute(true);
		if($Result && $Result->num_rows > 0)
			return (string)$Result->fetch_object()->SessionValue;;
		return '';
	}
	
	public function write($SessionID, $Data) {
		if(!$Data)
			return true;
		
		return (bool)SBB::DB()->Table('session')->Replace(
			array(
				'ID' => EscapeString($SessionID),
				'SessionValue' => EscapeString($Data),
				'UserID' => (int)(isset($_SESSION['UserID']) ? $_SESSION['UserID'] : 0),
				'Username' => '', // TODO: read Username from User class?
				'IPAddress' => (string)$_SERVER['REMOTE_ADDR'],
				'UserAgent' => EscapeString($_SERVER['HTTP_USER_AGENT']),
				'LastActivityTime' => time(),
				'Token' => (string)isset($_SESSION['Token']) ? $_SESSION['Token'] : ''
			))->Execute(true);
	}
	
	public function destroy($SessionID) {
		return (bool)SBB::DB()->Query('DELETE FROM `session` WHERE `ID` = \''.$SessionID.'\';')->Execute(true);
	}
	
	public function gc($MaxLife) {
		return (bool)SBB::DB()->Query('DELETE FROM `session` WHERE `LastActivityTime` < '.time() - $MaxLife)->Execute(true);
	}
}
?>