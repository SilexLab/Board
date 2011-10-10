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
			'Topics' => SBB::SQL()->GetObjects()->Select('thread', '*', 'BoardID=\''.$_GET['BoardID'].'\''),
			'Users' => SBB::SQL()->GetObjects()->Select('users', '*'),
			'Boards' => SBB::SQL()->GetObjects()->Select('board', '*', 'ID=\''.$_GET['BoardID'].'\'')
			));
		}
			
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>