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
			$Objects = SBB::SQL()->GetObjects()->Select('board', '*', 'ParentID='.$BoardID);
			SBB::SQL()->Select('board', '*', 'ID='.$BoardID);
			self::$CurrentBoardName = SBB::SQL()->FetchObject()->Title;
		} else {
			$Objects = SBB::SQL()->GetObjects()->Select('board');
			self::$CurrentBoardName = 'Home';
		}
		return $Objects;
	}
}
?>