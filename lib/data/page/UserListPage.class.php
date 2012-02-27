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
		Breadcrumb::Add(Language::Get('com.sbb.page.userlist'), self::$Link);
		$this->Info['template'] = 'UserList';
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