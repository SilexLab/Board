<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class RegisterPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Register',
		'Menu' => 'Home',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.register');
		
		
		// If logged in, redirect to start page	
		if(isset($_COOKIE['sbb_Token']) || Session::Read('UserID')) {
			header("Location: index.php");
		}
		
		$Message = '';
		if(isset($_POST['Register'])) {
			// Captcha doesn't work
			/*if($_POST['Captcha'] != $_SESSION['Captcha']) {
				$message = '{lang=com.sbb.captcha.wrong}';
			}
			else*/ if(Register::Check($_POST)) {
				User::Create($_POST['Username'], $_POST['Password'], $_POST['Email']);
				$Message = Language::Get('com.sbb.register.success');
			}
			else {
				$Message = '<b>'.Language::Get('com.sbb.error').':</b><ul><li>'.implode('</li><li>', Register::GetError()).'</li></ul>';
			}
		}
		
		// Füllt die Variablen im TPL
		SBB::Template()->Assign(array('Message' => $Message, 'Page' => 'Register'));
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>