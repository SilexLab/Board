<?php 
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */
 
class Login {
	private $Username, $Password, $StayLoggedIn;
	private static $Error = array();
	
	public function __construct() {
		$this->Username = mysql_real_escape_string($_POST['Username']);
		$this->Password = mysql_real_escape_string($_POST['Password']);
		isset($_POST['StayLoggedIn']) ? $this->StayLoggedIn = true : $this->StayLoggedIn = false;
		$this->Check();
	}
	
	public static function Check(array $Post) {
		$SQL = SBB::SQL();
		$SQL->Select('users', 'Salt, Password', 'Username = \''.mysql_real_escape_string($Post['Username']).'\'', '', 1);
		$Row = $SQL->FetchObject();
		if($SQL->NumRows() == 1) {
			if(User::EncryptPassword($Post['Password'], $Row->Salt) != $Row->Password) {
				self::$Error[] = Language::Get('com.sbb.login.wrong_password');
			}
			else {
				return true;
			}
		}
		else {
			self::$Error[] = Language::Get('com.sbb.login.notexist_username');
		}
		return false;
	}
	
	public static function GetError() {
		return self::$Error;
	}
}
?>