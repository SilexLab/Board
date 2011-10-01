<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class UserPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'User',
		'Menu' => 'UserList',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.user');
		
		if(isset($_GET['userID'])) {
			$UserInfos = array();
			SBB::SQL()->Select('users', '*', 'ID = \''.$_GET['userID'].'\'', 1);
			$Row = SBB::SQL()->FetchObject();
			$UserInfos[] = $Row;
			$Avatar = new Avatar($Row->Email, 100);
			
			SBB::Template()->Assign(array('Page' => 'userPage', 'UserInfos' => $UserInfos, 'Avatar' => $Avatar));
		}
		else {
			header('Location: ./');
		}
		
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>