<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class RegisterPage extends Page implements PageData {
	protected static $Link = '?page=Register';
	protected static $Node = 'page.register';
	protected $Info = array();

	public function __construct() {
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('sbb.page.register');
		Breadcrumb::Add(Language::Get('sbb.page.register'), self::$Link);
		$this->Info['template'] = 'Register';

		// Register formular
		if(!Session::Get('register.step'))
			Session::Set('register.step', 'register.username');

		$Steps = ['register.username', 'register.password', 'register.email', 'register.captcha']; // TODO
		while(true) {
			if(isset($_POST['sub_restart'])) {
				unset($_POST['sub_restart']);
				Session::Destroy();
				session_start();
			}

			switch(Session::Get('register.step')) {
				case 'register.username':
					if(isset($_POST['sub_username'])) {
						// TODO: Check username blub
						Session::Set('register.step', 'register.password');
						Session::Set('register.username', $_POST['Username']);
						break;
					}
					SBB::Template()->Set(['Register' => ['Progress' => 0]]);
					break 2;

				case 'register.password':
					if(isset($_POST['sub_back'])) {
						unset($_POST['sub_back']);
						Session::Set('register.step', 'register.username');
						break;
					}
					if(isset($_POST['sub_password'])) {
						// TODO: Check password blub
						Session::Set('register.step', 'register.email');
						Session::Set('register.password', $_POST['Password']);
						break;
					}
					SBB::Template()->Set(['Register' => ['Progress' => 25]]);
					break 2;
				
				case 'register.email':
					if(isset($_POST['sub_back'])) {
						unset($_POST['sub_back']);
						Session::Set('register.step', 'register.password');
						break;
					}
					if(isset($_POST['sub_email'])) {
						// TODO: Check password blub
						Session::Set('register.step', 'register.captcha');
						Session::Set('register.email', $_POST['Email']);
						break;
					}
					SBB::Template()->Set(['Register' => ['Progress' => 50]]);

					break 2;
				case 'register.captcha':
					if(isset($_POST['sub_back'])) {
						unset($_POST['sub_back']);
						Session::Set('register.step', 'register.email');
						break;
					}
					SBB::Template()->Set(['Register' => ['Progress' => 75]]);
					break 2;
				default:
					if(Session::Get('register.step'))
						Notification::Show('The registration process failed: "'.print_r(Session::Get('register.step'), true).'" is not a valid expression.', Notification::WARNING);
					Session::Set('register.step', 'register.username');
					break;
			}
		}

		$PasswordBullets = '';
		if(Session::Get('register.password'))
			for($i = 0; $i < strlen(Session::Get('register.password')); $i++)
				$PasswordBullets .= '•';

		$Avatar = 'styles/Lumen Lunae/icons/g_64_user.png';
		if(Session::Get('register.email'))
			$Avatar = 'http://www.gravatar.com/avatar/'.md5(strtolower(trim(Session::Get('register.email')))).'&s=64';

		SBB::Template()->Set(['Register' => ['Step' => Session::Get('register.step'),
			'Username' => Session::Get('register.username'),
			'Password' => $PasswordBullets,
			'RealPw' => Session::Get('register.password'),
			'Email' => Session::Get('register.email'),
			'Avatar' => $Avatar]]);
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