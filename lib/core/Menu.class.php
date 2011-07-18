<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 6
 */

class Menu {
	public static function Render() {
		//$Current = page::$Info['Site'];
		$Page = $_GET['page'];
		
		if($Current == 'Home')
			$Current = './';
		
		mysql::Select('menu', '*', NULL, 'Position');
		$MenuList = array();
		$Lang = SBB::Language();
		while ($row = mysql::FetchObject()) {
			if($Current == str_replace('?page=', '', $row->Link)) {
				$Item = array('Link' => $row->Link, 'Name' => $Lang->Get($row->MenuName), 'Active' => true);
			} else {
				$Item = array('Link' => $row->Link, 'Name' => $Lang->Get($row->MenuName), 'Active' => false);
			}
			$MenuList[] = $Item;
		}
		Template::Assign(array('Menu' => $MenuList));
	}
}
?>