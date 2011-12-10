<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class ForumList {
	private $Items = array();
	public static $CurrentBoardName;
	
	public static function ListForums($BoardID = 0) {
		if(isset($BoardID)) {
			$Objects = SBB::SQL()->Table('board')->Select('*')->Where('`ParentID` = '.$BoardID)->Execute()->FetchObjects();
			SBB::SQL()->Select('*')->Where('`ID` = '.$BoardID)->Limit(1)->Execute();
			self::$CurrentBoardName = SBB::SQL()->FetchObject()->Title;
		} else {
			$Objects = SBB::SQL()->Table('board')->Select()->Execute()->FetchObjects();
			self::$CurrentBoardName = 'Home';
		}
		return $Objects;
	}
}
?>