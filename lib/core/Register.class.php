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
	private static $Error = array();
	
	public static function Check(array $Post) {
		$SQL = SBB::SQL();
		
		if(!preg_match('/^[\w\.-\s]{4,32}$/', $Post['Username'])) {
			self::$Error[] = Language::Get('com.sbb.register.invalid_username');
		}
		if($Post['Password'] != $Post['PasswordRepeat']) {
			self::$Error[] = Language::Get('com.sbb.register.incorrect_password');
		}
		if($Post['Email'] != $Post['EmailRepeat']) {
			self::$Error[] = Language::Get('com.sbb.register.incorrect_email');
		}
		if(!preg_match('/^[\w\.-]+\@[\w\.-]+\.[\w]{2,3}$/', $Post['Email'])) {
			self::$Error[] = Language::Get('com.sbb.register.invalid_email');
		}
                
		$SQL->Select('users', 'UserName', 'Username = \''.mysql_real_escape_string($Post['Username']).'\'');
		if($SQL->NumRows() == 1) {
			self::$Error[] = Language::Get('com.sbb.register.username_exist');
		}
		
		$SQL->Select('users', 'Email', 'Email = \''.mysql_real_escape_string($Post['Email']).'\'');
		if($SQL->NumRows() == 1) {
			self::$Error[] = Language::Get('com.sbb.register.email_exist');
		}
		
		if(count(self::$Error) != 0) {
			return false;
		}
		return true;
	}
	
	public static function GetError() {
		return self::$Error;
	}
}
?>