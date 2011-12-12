<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class BoardPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Board',
		'Menu' => 'Forum',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.board');
		$BoardID = $_GET['BoardID'];
		SBB::Template()->Assign(array(
		'Page' => 'Board', 
		'Boards' => ForumList::ListForums($BoardID),
		'CurrentBoardName' => ForumList::$CurrentBoardName
		));
		
		Crumb::Add('com.sbb.crumbs.home', './');
		Crumb::Add('com.sbb.crumbs.forum', '?page=Board');
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
		
	}
	
}

?>