<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx, Nox Nebula
 * @copyright	2011 SilexBoard
 */

class register {
	protected static $error = '';
	
	public static function Check($post) {
		if(!preg_match('/^[A-Za-z0-9_]/', $post['username']))
			self::$error .= '{lang=com.sbb.register.invalid_username}';
		if($post['password'] != $post['passwordrepeat'])
			self::$error .= '{lang=com.sbb.register.incorrect_password}';
		if($post['email'] != $post['emailrepeat'])
			self::$error .= '{lang=com.sbb.register.incorrect_email}';
		$sql = new mysqlQuery;
		$sql->Select("users", "UserName", "Username = '".$post['username']."'");
		if($sql->NumRows() == 1)
			self::$error .= '{lang=com.sbb.register.username.exist}';
		$sql->Select("users", "Email", "Email = '".$post['email']."'");
		if($sql->NumRows() == 1)
			self::$error .= '{lang=com.sbb.register.email.exist}';
		
		if(!empty(self::$error))
			return false;
		return true;
	}
	
	public static function getError() {
		return self::$error;
	}
}
?>