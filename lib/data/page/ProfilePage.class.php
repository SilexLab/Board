<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class ProfilePage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Profile',
		'Menu' => 'Home',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.profile');
		
		
		// If logged in, redirect to start page	
		if(!User::LoggedIn()) {
			header("Location: index.php");
		}
		
		$Message = '';
		if(isset($_POST['Submit'])) {
			if(User::CheckUpdate($_POST)) {
				User::Update(array('Homepage' => $_POST['Homepage'], 'Signatur' => $_POST['Signature']));
				$Message = Language::Get('com.sbb.profile.success');
			}
			else {
				$Message = '<b>'.Language::Get('com.sbb.error').':</b><ul><li>'.implode('</li><li>', Register::GetError()).'</li></ul>';
			}
		}
		
		// Füllt die Variablen im TPL
		SBB::Template()->Assign(array('Homepage' => User::Get('Homepage'), 'Signature' => User::Get('Signatur'), 'Message' => $Message, 'Page' => 'Profile'));
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>