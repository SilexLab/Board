<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
 */

class user {
	public static function create($username, $password, $email) {
		$salt = sha1(md5(base64_encode(microtime())));
		$password = sha1($salt.md5($salt.sha1($password.md5($salt))));
		$key = substr(md5(base64_encode($password.$salt)), 0, 15);
		
		$sql = new mysql;
		$inserts = array('UserName' => $username,
				'Password' => $password,
				'Salt' => $salt,
				'Email' => $email,
				'ActivationKey' => $key,
				'RegisterTime' => time());
		$sql->Insert('users', $inserts);
	}
	
	public static function GetUsername($ID) {
		if(isset($ID)) {
			mysql::Select('users','*','ID='.$ID);
			$UserName = mysql::FetchObject()->UserName;	
			return $UserName;
		}
	}
	
		public static function GetEmail($ID) {
		if(isset($ID)) {
			mysql::Select('users','*','ID='.$ID);
			$Email = mysql::FetchObject()->Email;	
			return $Email;
		}
	}
}
?>