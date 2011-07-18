<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class Menu {
	public static function Render() {
		$ID = SBB::PageInfo()->Get('ID');
		if($ID == 'Home')
			$ID = './';
		
		MySQL::Select('menu', '*', NULL, 'Position');
		$MenuList = array();
		$Lang = SBB::Language();
		while ($Row = MySQL::FetchObject()) {
			if($ID == str_replace('?page=', '', $Row->Link)) { // Compare the Page ID with the Link in the Database
				$Item = array('Link' => $Row->Link, 'Name' => $Lang->Get($Row->MenuName), 'Active' => true);
			} else {
				$Item = array('Link' => $Row->Link, 'Name' => $Lang->Get($Row->MenuName), 'Active' => false);
			}
			$MenuList[] = $Item;
		}
		Template::Assign(array('Menu' => $MenuList));
	}
}
?>