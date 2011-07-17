<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

/* Die Register Klasse verwaltet die Eingaben der Registration und gibt eventuell Fehler aus. */
class Register {
	protected static $error = '';
	
	public static function Check($post) {
		$Lang = SBB::Language();
		
		if(!preg_match('/^[A-Za-z0-9_]/', $post['Username']))
			self::$error .= $Lang->Get('com.sbb.register.invalid_username');
		if($post['Password'] != $post['Passwordrepeat'])
			self::$error .= $Lang->Get('com.sbb.register.incorrect_password');
		if($post['Email'] != $post['Emailrepeat'])
			self::$error .= $Lang->Get('com.sbb.register.incorrect_email');
                
		mysql::Select('users', 'UserName', 'Username = \''.$post['Username'].'\'');
		if(mysql::NumRows() == 1)
			self::$error .= $Lang->Get('com.sbb.register.username_exist');
		mysql::Select('users', 'Email', 'Email = \''.$post['Email'].'\'');
		if(mysql::NumRows() == 1)
			self::$error .= $Lang->Get('com.sbb.register.email_exist');
		
		if(!empty(self::$error))
			return false;
		return true;
	}
	
	public static function getError() {
		return self::$error;
	}
}
?>