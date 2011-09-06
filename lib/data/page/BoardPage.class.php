<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class BoardPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Board',
		'Menu' => 'Board',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.board');
		SBB::Template()->Assign(array('Page' => 'Board'));
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
		
	}
	
}

?>