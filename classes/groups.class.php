<?php 
/**
 * @author		SilexBoard Team
 *					Nut
 * @copyright	2011 SilexBoard
 */

class groups {	
	public static function getRights() {
		$rights = array();
		$group = mysql::FetchObject(mysql::Select(DB_PREFIX.'users', 'GroupID', 'UserName="'.session::read('username').'"'))->GroupID;
		$rights = mysql::FetchArray(mysql::Select(DB_PREFIX.'groups', '*', 'ID="'.$group.'"'));
		return $rights;
	}
}
?>