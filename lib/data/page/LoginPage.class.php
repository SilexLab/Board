<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class LoginPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Login',
		'Menu' => 'Home',
	);
	
	public function __construct() {
		$this->Infos['Title'] = SBB::Language()->Get('com.sbb.page.login');
		
		// Falls eingeloggt, auf Startseite weiterleiten.	
		/*if(isset($_COOKIE['sbb_LoginHash']) || session::Read('UserID')) 
			header("Location: ?page=Home");
		
		switch($_POST['Register']) {
			case 1:
				$_SESSION['RegisterName'] = $_POST['Username'];
				$_SESSION['RegisterPass'] = $_POST['Password'];
				header("Location: ?page=Register");
				break;
			case 0:
				$Login = new login();
				$MSG = $Login->GetMSG();
				break;
		}
		Template::Assign(array('Page' => 'Login', 'LoginMessage' => $MSG));*/
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>