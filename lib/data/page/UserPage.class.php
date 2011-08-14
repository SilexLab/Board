<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class RegisterPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'User',
		'Menu' => 'User',
	);
	
	public function __construct() {
		$this->Infos['Title'] = SBB::Language()->Get('com.sbb.page.user');
		
		/*
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
		*/
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>