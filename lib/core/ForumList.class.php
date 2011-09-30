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
		foreach($Objects as $row) {
			$Item = array(	'ID' => $row->ID,
							'ParentID' => $row->ParentID,
							'Type' => $row->Type,
							'Title' => $row->Title,
							'Description' => $row->Description,
							'Link' => $row->Link,
							'Position' => $row->Position,
							'Image' => $row->Image,
							'Closed' => $row->Closed,
							'Status' => $row->Status);
			$Items[] = $Item;
		}
		return $Items;
	}
}
?>