<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class UserListPage extends Page implements PageInterface {
	private $Infos = array(
		'Page' => 'User',
		'Menu' => 'UserList',
	);
	
	public function __construct() {
		$this->Infos['Title'] = Language::Get('com.sbb.page.userlist');
		
		SBB::Template()->Assign(array('Page' => 'userList', 'Users' => SBB::SQL()->Table('users')->Select('*')->Execute()->FetchObjects()));
		
		Crumb::Add('com.sbb.crumbs.home', './');
		Crumb::Add('com.sbb.crumbs.user', '?page=UserList');	
	}
	
	public function GetInfo($Info = '') {
		return $Info == '' ? $this->Infos : (isset($this->Infos[$Info]) ? $this->Infos[$Info] : false);
	}
}
?>