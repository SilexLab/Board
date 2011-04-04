<?php
/**
 * @author		SilexBoard Team
 *					Nut
 * @copyright	2011 SilexBoard
 */

class Login {
	
	//check_user zum Usercheck ob er da is usw.
	public function check_user ($name, $pass) {
				
		// magic quotes anpassen, Ist diese Einstellung auf on, werden alle ' (einzelne Anführungszeichen), " (doppelte Anführungszeichen), \ (Backslash) und NUL's automatisch mit einem Backslash geschützt. 
		if (get_magic_quotes_gpc()) {
			$name = stripslashes($name);
			$pass = stripslashes($pass);
		}
		// escapen von \x00, \n, \r, \, ', " und \x1a
		$name = mysql_real_escape_string($name);
		// escapen von % und _
		$name = str_replace('%', '\%', $name);
		$name = str_replace('_', '\_', $name);
		
		//Prüft ob Name und Password stimmen
		$sql = new mysqlQuery;
		$sql->Select('users', 'Salt', 'UserName = \''.$name.'\'', '', 1);
		$salt = $sql->FetchObject()->Salt;
		$sql->Select('users', 'ID', 'UserName = \''.$name.'\' AND Password = \''.sha1($salt.md5($salt.sha1($pass.md5($salt)))).'\'');
		
		//Gibt UserId aus
		if ($row = $sql->numRows() == 1) {
			$user = $row = $sql->FetchArray();
			return ($user['ID']);
		} else {
			return (false);
		}
	}
	
	
	//speichert die Session zur richtigen ID, $userid kommt von check_user
	public function doLogin ($userid) {
		$sql = new mysqlQuery;
		$inserts = array("Time" => time(),
				"UserID" => $userid,
				"Salt" => session_id(),
				"IP" => $_SERVER['REMOTE_ADDR']);
		$sql->Insert("sessions", $inserts);
	}
	
	//wenn logged_in dann wird eingeloggte bereich gezeigt
	public function logged_in () {
		$sql = new mysqlQuery;
		$sql->Select('sessions', 'UserID', 'Salt = \''.session_id().'\'');
		return ($sql->NumRows() == 1);
	}
	
	//beim ausloggen wird die session auf NULL gesetzt
	public function DoLogout () {
		$sql = new mysqlQuery;
		$sql->Delete('sessions', 'Salt = \''.session_id().'\'');
	}

}
?>