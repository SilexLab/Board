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
		
		$sql = new mysqlQuery;
		$inserts = array("UserName" => $username,
				"Password" => $password,
				"Salt" => $salt,
				"Email" => $email,
				"ActivationKey" => $key,
				"RegisterTime" => time());
		$sql->Insert("users", $inserts);
	}
}
?>