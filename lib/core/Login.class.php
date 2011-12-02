<?php 
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */
 
class Login {
	private $Username, $Password, $StayLoggedIn;
	
	public function __construct() {
		$this->Username = mysql_real_escape_string($_POST['Username']);
		$this->Password = mysql_real_escape_string($_POST['Password']);
		
		isset($_POST['StayLoggedIn']) ? $this->StayLoggedIn = true : $this->StayLoggedIn = false;
		$this->Check();
	}
	
	public static function Check(array $Post) {
		SBB::SQL()->Select('users', 'Salt, Password', 'Username = \''.mysql_real_escape_string($Post['Username']).'\'', '', 1);
		$Row = SBB::SQL()->FetchObject();
		
		if(SBB::SQL()->NumRows() == 1) {
			if(User::EncryptPassword($Post['Password'], $Row->Salt) != $Row->Password)
				new MessageBox(Language::Get('com.sbb.login.wrong_password'), MessageBox::ERROR);
			else
				return true;
		} else
			new MessageBox(Language::Get('com.sbb.login.notexist_username'), MessageBox::ERROR);
		return false;
	}
}
?>