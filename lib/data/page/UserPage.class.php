<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 5
 */

class UserPage extends Page {
	protected static function Load() {	
		// Übergeordnete Seite
		page::$Info['Site'] = 'User';
		
		$Parser = new messageParser();
		
		if(isset($_GET['userID'])) {
			$UserInfos = array();
			MySQL::Select('users', '*', 'ID = \''.$_GET['userID'].'\'', 1);
			$Row = MySQL::FetchArray();
			$UserInfos[] = $Row;
			$Avatar = new avatar($Row['Email'], 100);
			
			Template::Assign(array('Page' => 'userPage', 'UserInfos' => $UserInfos, 'Avatar' => $Avatar));
		}
		else {
			$Users = array();
			MySQL::Select('users', '*');
			while($Row = MySQL::FetchArray()) {
				$Users[] = $Row;
			}
			Template::Assign(array('Page' => 'userList', 'Users' => $Users));
		}
	}
}
?>