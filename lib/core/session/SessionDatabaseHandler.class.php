<?php
/**
 * @author     SilexBB
 * @copyright  2011 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SessionDatabaseHandler extends SessionHandler {
	public function __construct() {
		// Session preparation
		ini_set('session.gc_maxlifetime', SBB::Config('config.user.autologout'));
		ini_set('session.gc_probability', SBB::Config('config.user.extra.autologout_probability'));
		ini_set('session.gc_divisor', 100);
		ini_set('session.save_handler', 'user');
		
		// Own save handler
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);
		register_shutdown_function('session_write_close');
	}
	
	public function open($Path, $Name) {
		return true;
	}
	
	public function close() {
		$this->GC((int)SBB::Config('config.user.autologout'));
		return true;
	}
	
	public function read($SessionID) {
		if(SBB::SQL()->Table('session')->Select('SessionValue')->Where('`ID` = \''.SBB::SQL()->RealEscapeString($SessionID).'\'')->Limit(1)->Execute() !== false)
			return (string)SBB::SQL()->FetchObject()->SessionValue;
		return '';
	}
	
	public function write($SessionID, $Data) {
		return (bool)SBB::SQL()->Table('session')->Replace(
			array(
				'ID' => SBB::SQL()->RealEscapeString($SessionID),
				'SessionValue' => SBB::SQL()->RealEscapeString($Data),
				'UserID' => User::GetUserID(),
				'IPAddress' => $_SERVER['REMOTE_ADDR'],
				'UserAgent' => SBB::SQL()->RealEscapeString($_SERVER['HTTP_USER_AGENT']),
				'LastActivityTime' => time(),
				'Token' => sha1(md5(mt_rand()).microtime().mt_rand())
			))->Execute();
	}
	
	public function destroy($SessionID) {
		return (bool)SBB::SQL()->Table('session')->Delete()->Where('`ID` = \''.SBB::SQL()->RealEscapeString($SessionID).'\'')->Execute();
	}
	
	public function gc($MaxLife) {
		return (bool)SBB::SQL()->Table('session')->Delete()->Where('`LastActivityTime` < '.time() - $MaxLife)->Execute();
	}
}
?>