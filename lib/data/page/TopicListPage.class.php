<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class TopicListPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'TopicList',
		'Menu' => 'Forum',
	);
	
	public function __construct() {
		//$this->Infos['Title'] = SBB::Language()->Get('com.sbb.page.topiclist');
		
		if(!isset($_GET['BoardID']))
			header('Location: ./');
		else {
			SBB::Template()->Assign(array(
			'Page' => 'TopicList',
			'Topics' => SBB::SQL()->Table('thread')->Select('*')->Where('`BoardID` = \''.$_GET['BoardID'].'\'')->Execute()->FetchObjects(),
			'Users' => SBB::SQL()->Table('users')->Select('*')->Execute()->FetchObjects(),
			'Boards' => SBB::SQL()->Table('board')->Select('*')->Where('`ID` = \''.$_GET['BoardID'].'\'')->Execute()->FetchObjects()
			));
		}
		
		Crumb::Add('com.sbb.crumbs.home', './');
		Crumb::Add('com.sbb.crumbs.forum', '?page=Board');
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>