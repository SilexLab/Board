<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 6
 */

class menu {
	public static function Parse() {
		$Current = page::$Info['Site'];
		$Page = $_GET['page'];
		
		if($Current == 'Home')
			$Current = './';
		
		mysql::Select('menu', '*', NULL, 'Position');
		while ($row = mysql::FetchObject()) {
			if($Current == str_replace('?page=', '', $row->Link))
				$Return .= '				<li class="active"><a href="'.$row->Link.'"><div>'.$row->MenuName.'</div></a></li>';
			else
				$Return .= '				<li><a href="'.$row->Link.'"><div>'.$row->MenuName.'</div></a></li>';
		}
		return $Return;
	}
}
?>