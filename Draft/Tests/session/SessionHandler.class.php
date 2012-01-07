<?php
class SessionHandler {
	private $DB = NULL;
	public function __construct(MySQLi $MySQL) {
		$this->DB = $MySQL;
	
		//ini_set('session.save_handler', 'user');
		ini_set('session.hash_function', 1);
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
		//$this->GC(ini_get('session.gc_maxlifetime'));
		return true;
	}
	
	public function read($SessionID) {
		$Result = $this->DB->query('SELECT * FROM `session` WHERE `ID` = \''.$SessionID.'\' LIMIT 1;');
		if($Result && $Result->num_rows > 0)
			return $Result->fetch_object()->SessionValue;
		return '';
	}
	
	public function write($SessionID, $Data) {
		if(!$Data)
			return true;
		
		$Ret = (bool)$this->DB->query('REPLACE INTO `session`
			(`ID`, `SessionValue`, `UserID`, `IPAddress`, `UserAgent`, `LastActivityTime`, `Token`)
			VALUES
			(
				\''.$this->DB->real_escape_string($SessionID).'\',
				\''.$this->DB->real_escape_string($Data).'\',
				'.(isset($_SESSION['UserID']) ? $_SESSION['UserID'] : 0).',
				\''.$_SERVER['REMOTE_ADDR'].'\',
				\''.$this->DB->real_escape_string($_SERVER['HTTP_USER_AGENT']).'\',
				'.time().',
				\''.(isset($_SESSION['Token']) ? $_SESSION['Token'] : '').'\'
			);');
		
		echo 'Ret: '.($Ret === false ? 0 : 1);
		echo '<pre>'.print_r($this->DB, true).'</pre>';
		return $Ret;
	}
	
	public function destroy($SessionID) {
		return (bool)$this->DB->query('DELETE FROM `session` WHERE `ID` = \''.$SessionID.'\';');
	}
	
	public function gc($MaxLife) {
		return (bool)$this->DB->query('DELETE FROM `session` WHERE `LastActivityTime` < '.time() - $MaxLife);
	}
}
?>