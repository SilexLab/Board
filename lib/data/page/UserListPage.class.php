<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserListPage extends Page implements PageData {
	protected static $Link = ['page' => 'UserList'];
	protected static $Node = 'page.userlist';
	protected $Info = array();

	public function __construct() {
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('sbb.page.userlist');
		$this->Info['template'] = 'UserList';
		Breadcrumb::Add(Language::Get('sbb.page.userlist'), self::Link());

		$TempUsers = SBB::DB()->query('SELECT * FROM `users`')->fetchAll(PDO::FETCH_OBJ);
		$Users = [];
		foreach($TempUsers as $User) {
			$Users[] = [
				'name'     => $User->Username,
				'link'     => URI::Make(['page' => 'User', 'UserID' => $User->ID]),
				'group'    => '',
				'joined_d' => date('d. ', $User->Joined).Language::Get(Time::Month(date('n', $User->Joined))).date(' Y', $User->Joined),
				'joined_t' => date('H:i', $User->Joined),
				'posts'    => '-',
				'language' => $User->Language,
				'homepage' => $User->Homepage
			];
		}

		SBB::Template()->assign(['users' => $Users]);
	}

	public function GetInfo($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetWholeInfo() {
		return $this->Info;
	}

	public static function Link() {
		return URI::Make(self::$Link);
	}

	public static function Node() {
		return self::$Node;
	}
}
?>