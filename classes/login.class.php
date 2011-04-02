<?php
include('mysql.class.php');
class Login extends mysql {
	
	public function check_user ($name, $pass) {
		// magic quotes anpassen
		if ( get_magic_quotes_gpc() ) {
			$name = stripslashes($name);
			$pass = stripslashes($pass);
		}
		// escapen von \x00, \n, \r, \, ', " und \x1a
		$name = mysql_real_escape_string($name);
		// escapen von % und _
		$name = str_replace('%', '\%', $name);
		$name = str_replace('_', '\_', $name);
	
		$sql = 'SELECT UserId FROM users WHERE UserName = \'' . $name . '\' AND UserPass=\'' . md5($pass) . '\'';
		if (!$result = mysql_query($sql)) {
			exit(mysql_error());
		}
		if (mysql_num_rows($result) == 1) {
			$user = mysql_fetch_assoc($result);
			return ($user['UserId']);
		} else {
			return (false);
		}
	}
	
	public function login ($userid) {
		$sql = 'UPDATE users SET UserSession = \'' . session_id() . '\' WHERE UserId = ' . ((int)$userid);
		if (!mysql_query($sql)) {
			exit(mysql_error());
		}
	}
	
	public function logged_in () {
		$sql = 'SELECT UserId FROM users WHERE UserSession = \'' . session_id() . '\'';
		if (!$result = mysql_query($sql)) {
			exit(mysql_error());
		}
		return (mysql_num_rows($result) == 1);
	}
	
	public function logout () {
		$sql = 'UPDATE users SET UserSession = NULL WHERE UserSession = \'' . session_id() . '\'';
		if (mysql_query($sql)) {
			exit(mysql_error());
		}
	}

}

$connect = new mysql;
$connect->Connect();
?>