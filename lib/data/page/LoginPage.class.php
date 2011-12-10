<?php
/**
 * @author 		Cadillaxx
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
		if(User::LoggedIn()) {
			header('Location: ./');
		}
		
		$Message = '';
		if(isset($_POST['Login'])) {
			if(Login::Check($_POST)) {
				SBB::SQL()->Table('users')->Select('ID')->Where('`Username` = \''.SBB::SQL()->RealEscapeString($_POST['Username']).'\'')->Limit(1)->Execute();
				$UserID = SBB::SQL()->FetchObject()->ID;
				User::Login($UserID, $_POST['StayLoggedIn']);
				
				new MessageBox(Language::Get('com.sbb.login.success'), MessageBox::SUCCESS);
				header('Location: ./');
			}
		}
		
		SBB::Template()->Assign(array('Page' => 'Login', 'Message' => $Message));
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>