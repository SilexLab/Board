<?php 
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 2
 */

class groups {	
	public static function getRights() {
		$rights = array();
		$group = mysql::FetchObject(mysql::Select('users', 'GroupID', 'UserName="'.session::read('username').'"'))->GroupID;
		$rights = mysql::FetchArray(mysql::Select('groups', '*', 'ID="'.$group.'"'));
		return $rights;
	}
}
?>