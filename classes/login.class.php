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
	public static function DoLogin ($userid, $allwaysLogged) {
		if($allwaysLogged == true) {
			setcookie('sbb_UserId', $userid, time()+60*60*24*365);
			session::set('username', $_POST['Username']);
			$str = session_id();
			setcookie('sbb_loginHash', md5($str.sha1($str)), time()+60*60*24*365);
			$inserts = array("Time" => time(),
					"UserID" => $userid,
					"Salt" => md5($str.sha1($str)),
					"IP" => $_SERVER['REMOTE_ADDR']);
		} else {
			session::set('userid', $userid);
			setcookie('sbb_UserId', $userid, time()+60*60*24*365);
			session::set('username', $_POST['Username']);
			$inserts = array("Time" => time(),
					"UserID" => $userid,
					"Salt" => session_id(),
					"IP" => $_SERVER['REMOTE_ADDR']);
		}
		mysql::Insert("sessions", $inserts);
	}
	
	//wenn logged_in dann wird eingeloggte bereich gezeigt
	public static function logged_in () {
		if(isset($_COOKIE['sbb_loginHash'])) {
			mysql::Select('sessions', 'UserID', 'Salt = \''.$_COOKIE['sbb_loginHash'].'\'');
			return (mysql::NumRows() == 1);
		} else {
			mysql::Select('sessions', 'UserID', 'Salt = \''.session_id().'\'');
			return (mysql::NumRows() == 1);
		}
	}
	
	//beim ausloggen wird die session auf NULL gesetzt
	public static function DoLogout () {
		mysql::Delete('sessions', 'Salt = \''.session_id().'\'');
		mysql::Delete('sessions', 'Salt = \''.$_COOKIE['sbb_loginHash'].'\'');
		session::remove('username');
		session::remove('userid');
		setcookie('sbb_UserId', '', time()-60*60*24*365);
		setcookie('sbb_loginHash', '', time()-60*60*24*365);
	}
	
	//After 10 minutes you will automatically logged out
	public static function autoLogout() {
		if(login::logged_in()) {
			if(!isset($_COOKIE['sbb_loginHash'])) {
				mysql::Select('sessions', 'Time', 'Salt=\''.session_id().'\'');
				
				while($row = mysql::FetchArray()) {
					$lastTime = $row['Time'];
				}	
				
				$timeFuture = time() + 10 * 6;
				
				if($timeFuture - $lastTime > 600) {
					header("Location: logout.php");
				} else {
					$update = array("Time" => time());
					mysql::Update('sessions', $update, 'Salt=\''.session_id().'\'');
				}
			}
		}	
	}

	//Gibt Username aus
	public static function GetUsername ($userid) {
		if(Login::logged_in()==1) {
			$username = mysql::FetchObject(mysql::Select('users','*','`ID`='.$userid))->UserName;
			return($username);
		}
		else
			return false;
	}

}
?>