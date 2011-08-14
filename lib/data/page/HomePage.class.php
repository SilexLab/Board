<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class HomePage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Home',
		'Menu' => 'Home',
	);
	
	public function __construct() {
		$this->Infos['Title'] = SBB::Language()->Get('com.sbb.page.home');
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>