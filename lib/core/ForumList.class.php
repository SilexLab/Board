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
	
	public static function ListForums() {
		MySQL::Select('forums');
		$Objects = MySQL::GetObjects();
		foreach($Objects as $row) {
			if($row->Parent != 0) {
				$Item = array('ID' => $row->ID, 'Type' => $row->Type, 'isChild' => true, 'Title' => $row->Title, 'Description' => $row->Description, 'Position' => $row->Position, 'Permission' => $row->Permission, 'Status' => $row->Status);
			} else {
				$Item = array('ID' => $row->ID, 'Type' => $row->Type, 'isChild' => false, 'Title' => $row->Title, 'Description' => $row->Description, 'Position' => $row->Position, 'Permission' => $row->Permission, 'Status' => $row->Status);
			}
			$Items[] = $Item;
		}
		return $Items;
	}
}
?>