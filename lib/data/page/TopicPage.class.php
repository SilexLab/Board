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
			$Post = array();
			$Objs = SBB::SQL()->Table('post')->Select('*')->Where('`ThreadID` = \''.$_GET['TopicID'].'\'')->Execute()->FetchObjects();
			foreach($Objs as $Obj) {
				$Post[] = array(
					'ID' => $Obj->ID,
					'ThreadID' => $Obj->ThreadID,
					'UserID' => $Obj->UserID,
					'Subject' => htmlentities($Obj->Subject),
					'Message' => htmlentities($Obj->Message),
					'Time' => $Obj->Time,
					'LastEdit' => $Obj->LastEdit,
					'EditorID' => $Obj->EditorID,
					'PollID' => $Obj->PollID,
					'IPAddress' => $Obj->IPAddress,
					'Disabled' => $Obj->Disabled,
					'Closed' => $Obj->Closed,
					'Deleted' => $Obj->Deleted,
					'DeleteReason' => htmlentities($Obj->DeleteReason),
					'DeleteTime' => $Obj->DeleteTime,
					'Smileys' => $Obj->Smileys,
					'HTML' => $Obj->HTML,
					'SilexCode' => $Obj->SilexCode,
				);
			}
			
			SBB::Template()->Assign(array('Page' => 'Post', 'Posts' => $Post));
		}
		
		Crumb::Add('com.sbb.crumbs.home', './');
		Crumb::Add('com.sbb.crumbs.forum', '?page=Board');
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>