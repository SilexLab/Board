<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
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
                
		mysql::Select('users', 'UserName', 'Username = \''.$post['Username'].'\'');
		if(mysql::NumRows() == 1)
			self::$error .= '{lang=com.sbb.register.username.exist}';
		mysql::Select('users', 'Email', 'Email = \''.$post['Email'].'\'');
		if(mysql::NumRows() == 1)
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