<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

class user {
	public static function create($username, $password, $email) {
		$salt = sha1(md5(base64_encode(microtime())));
		$password = sha1($salt.md5($salt.sha1($password.md5($salt))));
		$key = substr(md5(base64_encode($password.$salt)), 0, 15);
		
		$sql = "INSERT INTO users (`UserName`, `Password`, `Salt`, `Email`, `Key`, `RegisterTime`) VALUES ('".$username."', '".$password."', '".$salt."', '".$email."', '".$key."', 'CURRENT_TIMESTAMP')";
		
		include_once('config.inc.php');
		$mysql = new mysql($CFG_Host, $CFG_User, $CFG_Password, $CFG_Database);
		$mysql->DoQuery($sql);
	}
}
?>