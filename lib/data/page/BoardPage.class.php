<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class BoardPage extends Page implements PageData {
	protected static $Link = '?page=Board';
	protected static $Node = 'page.forum';
	protected $Info = array();

	public function __construct() {
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('com.sbb.page.forum');
		$this->Info['template'] = 'Board';
		Breadcrumb::Add(Language::Get('com.sbb.page.forum'), self::$Link);
		
		$BoardID = isset($_GET['BoardID']) ? (int)$_GET['BoardID'] : 0;

		// Breadcrumbs
		if($BoardID > 0) {
			// Find Breadcrumbs
			$Crumbs = $this->GetBreadcrumbs($BoardID);
			foreach($Crumbs as $Crumb) {
				Breadcrumb::Add($Crumb['Title'], $Crumb['Link']);
			}
		}
		SBB::Template()->Set(array('Board' => $this->GetBoardList($BoardID)));
	}

	public function GetInfo($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetWholeInfo() {
		return $this->Info;
	}

	public static function Link() {
		return self::$Link;
	}

	public static function Node() {
		return self::$Node;
	}

	protected function GetBoardList($BoardID, $Depth = 0) {
		$Board = SBB::DB()->Table('board')->
			Select(array('ID', 'ParentID', 'Type', 'Title', 'Description', 'Link', 'Views', 'Threads', 'Posts', 'Invisible'))->
			Where('`ParentID` = '.$BoardID)->Order('Position')->Execute()->FetchObjects();

		$Depth++;
		$BoardList = array();
		foreach($Board as $Entry) {
			$BoardList[] = array(
				'Type'         => $Entry->Type,
				'Title'        => htmlspecialchars($Entry->Title),
				'Description'  => htmlspecialchars($Entry->Description),
				'Link'         => $Entry->Type == 2 ? htmlspecialchars($Entry->Link) : '?page=Board&BoardID='.$Entry->ID,
				'Stats'        => $Entry->Type == 2 ? ('Views: '.$Entry->Views) : ('Threads: '.$Entry->Threads.', Posts: '.$Entry->Posts.', Views: '.$Entry->Views),
				'LastPost'     => 0,
				'LastPostUser' => 'None',
				'SubBoard'     => $Depth < 2 ? $this->GetBoardList($Entry->ID, $Depth) : false
			);
		}
		return $BoardList;
	}

	protected function GetBreadcrumbs($BoardID) {
		$Board = SBB::DB()->Table('board')->
			Select(array('ID', 'ParentID', 'Title', 'Type', 'Link'))->
			Where('`ID` = '.$BoardID)->Execute()->FetchObject();

		$Crumbs = array();
		if($Board->ParentID != 0)
			$Crumbs = $this->GetBreadcrumbs($Board->ParentID);
		$Crumbs[] = array('Title' => htmlspecialchars($Board->Title), 'Link' => $Board->Type == 2 ? htmlspecialchars($Board->Link) : '?page=Board&BoardID='.$Board->ID);
		$this->Info['title'] = htmlspecialchars($Board->Title);
		return $Crumbs;
	}
}
?>