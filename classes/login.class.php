<?php
/**
 * @author		SilexBoard Team
 *					Nut, Cadillaxx, Nox Nebula
 * @copyright	2011 SilexBoard
 */

class login {
	
	//check_user zum Usercheck ob er da is usw.
	public static function check_user ($name, $pass) {
				
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
		mysql::Select('users', 'Salt', 'UserName = \''.$name.'\'', '', 1);
		if ($row = mysql::numRows() == 1) {
                    $salt = mysql::FetchObject()->Salt;
                    mysql::Select('users', 'ID', 'UserName = \''.$name.'\' AND Password = \''.sha1($salt.md5($salt.sha1($pass.md5($salt)))).'\'');
                }
		
		//Gibt UserId aus
		if ($row = mysql::numRows() == 1) {
			$user = $row = mysql::FetchObject();
			return ($user->ID);
		} else {
			return (false);
		}
	}
	
	
	//speichert die Session zur richtigen ID, $userid kommt von check_user
	public static function DoLogin ($userid) {
		$inserts = array("Time" => time(),
				"UserID" => $userid,
				"Salt" => session_id(),
				"IP" => $_SERVER['REMOTE_ADDR']);
		mysql::Insert("sessions", $inserts);
	}
	
	//wenn logged_in dann wird eingeloggte bereich gezeigt
	public static function logged_in () {
		mysql::Select('sessions', 'UserID', 'Salt = \''.session_id().'\'');
		return (mysql::NumRows() == 1);
	}
	
	//beim ausloggen wird die session auf NULL gesetzt
	public static function DoLogout () {
		mysql::Delete('sessions', 'Salt = \''.session_id().'\'');
	}

}
?>