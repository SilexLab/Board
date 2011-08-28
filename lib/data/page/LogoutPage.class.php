<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class LogoutPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Logout',
		'Menu' => 'Home',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.logout');
		
		User::Logout();
		header("Location: index.php");
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>