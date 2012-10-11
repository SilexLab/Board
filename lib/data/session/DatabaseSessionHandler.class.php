<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class DatabaseSessionHandler implements SessionHandlerInterface {
	private
		$DB = null,
		$Table = '';

	public function __construct(PDO $DB, $Table) {
		$this->DB = $DB;
		$this->Table = $Table;

		ini_set('session.save_handler', 'user');
	}

	public function open($save_path, $session_id) {
		return true;
	}

	public function close() {
		return true;
	}

	public function read($session_id) {
		$STMT = $this->DB->prepare('SELECT * FROM `'.$this->Table.'` WHERE `ID` = :ID LIMIT 1');
		$STMT->execute([':ID' => $session_id]);
		$Result = $STMT->fetch(PDO::FETCH_OBJ);
		if($Result)
			return $Result->SessionValue;
		return '';
	}

	public function write($session_id, $session_data) {
		if(!$session_data)
			return true;

		$STMT = $this->DB->prepare('SELECT COUNT(*) FROM `'.$this->Table.'` WHERE `ID` = :ID');
		$STMT->execute([':ID' => $session_id]);
		if($STMT->fetch(PDO::FETCH_ASSOC)['COUNT(*)'] == 0) {
			$STMT = $this->DB->prepare('INSERT INTO `'.$this->Table.'` (`ID`, `SessionValue`, `LastActivityTime`) VALUES (:ID, :Value, :Time)');
			return (bool)$STMT->execute([':ID' => $session_id, ':Value' => $session_data, ':Time' => time()]);
		}

		$STMT = $this->DB->prepare('UPDATE `'.$this->Table.'` SET `SessionValue` = :Value, `LastActivityTime` = :Time WHERE `ID` = :ID');
		return (bool)$STMT->execute([':ID' => $session_id, ':Value' => $session_data, ':Time' => time()]);
	}

	public function destroy($session_id) {
		$STMT = $this->DB->prepare('DELETE FROM `'.$this->Table.'` WHERE `ID` = :ID');
		return (bool)$STMT->execute([':ID' => $session_id]);
	}

	public function gc($maxlifetime) {
		$STMT = $this->DB->prepare('DELETE FROM `'.$this->Table.'` WHERE `LastActivityTime` < :Time');
		return (bool)$STMT->execute([':Time' => time() - $maxlifetime]);
	}
}
