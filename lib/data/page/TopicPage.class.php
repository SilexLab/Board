<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class TopicPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'Topic',
		'Menu' => 'Forum',
	);
	
	public function __construct() {
		//$this->Infos['Title'] = SBB::Language()->Get('com.sbb.page.topiclist');
		
		if(!isset($_GET['TopicID']))
			header('Location: ./');
		else {
			SBB::Template()->Assign(array('Page' => 'Post', 'Posts' => SBB::SQL()->GetObjects()->Select('post', '*', 'ThreadID=\''.$_GET['TopicID'].'\'')));
		}
			
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>