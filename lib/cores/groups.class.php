<?php 
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 5
 */

class groups {	
	public static function GetRights() {
		$Rights = array();
		$Group = mysql::FetchObject(mysql::Select('users', 'GroupID', 'ID="'.session::Read('userid').'"'))->GroupID;
		$Rights = mysql::FetchArray(mysql::Select('groups', '*', 'ID="'.$group.'"'));
		return $Rights;
	}
}
?>