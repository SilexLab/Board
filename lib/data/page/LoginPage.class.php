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
		$this->Infos['Title'] = Language::Get('com.sbb.page.login');
		
		// If logged in, redirect to start page
		if(isset($_COOKIE['sbb_Token']) || session::Read('UserID')) {
			header("Location: index.php");
		}
		
		$Message = '';
		if(isset($_POST['Login'])) {
			if(Login::Check($_POST)) {
				SBB::SQL()->Select('users', 'ID', 'Username = \''.mysql_real_escape_string($_POST['Username']).'\'', '', 1);
				$UserID = SBB::SQL()->FetchObject()->ID;
				User::Login($UserID, $_POST['StayLoggedIn']);
				
				$Message = Language::Get('com.sbb.login.success');
				header('Location: index.php');
			}
			else {
				$Message = '<b>'.Language::Get('com.sbb.error').':</b><ul><li>'.implode('</li><li>', Login::GetError()).'</li></ul>';
			}
		}
		
		SBB::Template()->Assign(array('Page' => 'Login', 'Message' => $Message));
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>