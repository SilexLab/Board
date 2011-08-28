<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class ErrorPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Error',
		'Menu' => 'Home'
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.error');
		
		$Type = isset($_GET['type']) ? $_GET['type'] : 404;
		SBB::Template()->Assign(array('Page' => 'Error', 'ErrorType' => $Type));
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>