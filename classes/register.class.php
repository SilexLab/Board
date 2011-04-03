<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

class register {
	protected static $error = '';
	
	public static function Check($post) {
		if(!preg_match('/^[A-Za-z0-9_]/', $post['username']))
			self::$error .= "Ungültiger Benutzername<br>\n";
		if($post['password'] != $post['passwordrepeat'])
			self::$error .= "Die Passwörter stimmen nicht überein<br>\n";
		if($post['email'] != $post['emailrepeat'])
			self::$error .= "Die E-Mail Adressen stimmen nicht überein<br>\n";
		
		if(!empty(self::$error))
			return false;
		return true;
	}
	
	public static function getError() {
		return self::$error;
	}
}
?>