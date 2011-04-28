<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx, Nox Nebula
 * @copyright	2011 SilexBoard
 */

class register {
	protected static $error = '';
	
	public static function Check($post) {
		if(!preg_match('/^[A-Za-z0-9_]/', $post['Username']))
			self::$error .= '{lang=com.sbb.register.invalid_username}';
		if($post['Password'] != $post['Passwordrepeat'])
			self::$error .= '{lang=com.sbb.register.incorrect_password}';
		if($post['Email'] != $post['Emailrepeat'])
			self::$error .= '{lang=com.sbb.register.incorrect_email}';
		$sql = new mysql;
		$sql->Select("users", "UserName", "Username = '".$post['Username']."'");
		if($sql->NumRows() == 1)
			self::$error .= '{lang=com.sbb.register.username.exist}';
		$sql->Select("users", "Email", "Email = '".$post['Email']."'");
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