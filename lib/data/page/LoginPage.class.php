<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class LoginPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'Login']]);
	}

	public function Display(Page $P) {
		if(SBB::User()->LoggedIn())
			header('location: ./');
		
		Breadcrumb::Add(Language::Get('sbb.page.login'), self::Link());

		if(Session::Get('LoginError')) {
			Notification::Show(Language::Get(Session::Get('LoginError')), Notification::ERROR);
			unset($_SESSION['LoginError']);
		}
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return Language::Get('sbb.page.login');
	}

	public function Template() {
		return 'PageLogin.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
