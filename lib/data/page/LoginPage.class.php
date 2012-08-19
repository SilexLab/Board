<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class LoginPage extends Page implements PageData {
	protected static $Link = ['page' => 'Login'];
	protected static $Node = 'page.login';
	protected $Info = array();

	public function __construct() {
		if(SBB::User()->LoggedIn())
			header('location: ./');
		
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('sbb.page.login');
		Breadcrumb::Add(Language::Get('sbb.page.login'), self::Link());
		$this->Info['template'] = 'Login';
		
		if(Session::Get('LoginError')) {
			Notification::Show(Language::Get(Session::Get('LoginError')), Notification::ERROR);
			unset($_SESSION['LoginError']);
		}
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