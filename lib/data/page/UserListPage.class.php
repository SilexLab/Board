<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserListPage extends Page implements PageData {
	protected static $Link = '?page=UserList';
	protected static $Node = 'page.userlist';
	protected $Info = array();

	public function __construct() {
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('com.sbb.page.userlist');
		$this->Info['template'] = 'UserList';
		Breadcrumb::Add(Language::Get('com.sbb.page.userlist'), self::$Link);

		$TempUsers = SBB::DB()->Table('users')->Select()->Execute()->FetchObjects();
		$Users = array();
		foreach($TempUsers as $User) {
			$Users[] = array(
				'ID'       => $User->ID,
				'Name'     => $User->Username,
				'Group'    => '',
				'Joined_D' => date('d. ', $User->Joined).Language::Get(Time::Month(date('j', $User->Joined))).date(' Y', $User->Joined),
				'Joined_T' => date('H:i', $User->Joined),
				'Posts'    => '-',
				'Language' => $User->Language,
				'Homepage' => $User->Homepage
			);
		}

		SBB::Template()->Set(array('Users' => $Users));
	}

	public function GetInfo($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetWholeInfo() {
		return $this->Info;
	}

	public static function Link() {
		return self::$Link;
	}

	public static function Node() {
		return self::$Node;
	}
}
?>