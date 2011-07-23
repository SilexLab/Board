<?php 
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */
 
class Login {
	private $Username, $Password, $StayLoggedIn;
	private $UserID;
	private $MSG = '';
	
	public function __construct() {
		$this->Username = mysql_real_escape_string($_POST['Username']);
		$this->Password = mysql_real_escape_string($_POST['Password']);
		isset($_POST['StayLoggedIn']) ? $this->StayLoggedIn = true : $this->StayLoggedIn = false;
		$this->Check();
	}
	
	public function Check() {
		$Lang = SBB::Language();
		$Salt = mysql::FetchObject(mysql::Select('users', 'Salt', 'UserName = \''.$this->Username.'\'', '', 1))->Salt;
		if(mysql::NumRows() == 1) {
			mysql::Select('users', 'ID', 'UserName = \''.$this->Username.'\' AND Password = \''.User::EncryptPassword($this->Password, $Salt).'\'');
			$this->UserID = mysql::FetchObject()->ID;
			$this->UserID == 0 ? $this->MSG = $Lang->Get('com.sbb.login.wrongdata') : $this->DoLogin(); 
		}
		elseif(isset($_POST['SubmitLogin'])) 
			$this->MSG = $Lang->Get('com.sbb.login.wrongdata');
	}
	
	public function DoLogin() {
		$Hash = $this->GenLoginHash();
		switch($this->StayLoggedIn) {
			case true:
			 	session::Set('UserID', $this->UserID);
				setcookie('sbb_LoginHash', $Hash, time()+60*60*24*365);
				$Inserts = array(
					'Time' 			=> time(),
					'UserID' 		=> $this->UserID,
					'LoginHash'		=> $Hash,
					'IP'			=> $_SERVER['REMOTE_ADDR']);
				break;	
			case false: 
				session::Set('UserID', $this->UserID);
				session::Set('LoginHash', $Hash);
				$Inserts = array(
					'Time' 			=> time(),
					'UserID' 		=> $this->UserID,
					'LoginHash'		=> $Hash,
					'IP'			=> $_SERVER['REMOTE_ADDR']);
				break;
		}
		mysql::Insert('sessions', $Inserts);
		header('Location: ?page=Home');
	}
	
	public static function LoggedIn() {
		if(isset($_COOKIE['sbb_LoginHash'])) {
			mysql::Select('sessions', 'UserID', 'LoginHash = \''.mysql_real_escape_string($_COOKIE['sbb_LoginHash']).'\'');
			isset($_SESSION['UserID']) ? '' : session::Set('UserID', self::GetUserID());
			return (mysql::NumRows() == 1);
		} else {
			mysql::Select('sessions', 'UserID', 'LoginHash = \''.session::Read('LoginHash').'\'');
			return (mysql::NumRows() == 1);
		}
	}
	
	public static function DoLogout() {
		mysql::Delete('sessions', 'LoginHash = \''.$_COOKIE['sbb_LoginHash'].'\'');
		mysql::Delete('sessions', 'LoginHash = \''.session::Read('LoginHash').'\'');
		session::Remove('UserID');
		session::Remove('LoginHash');
		setcookie('sbb_LoginHash', '', time()-60*60*24*365);
	}
	
	public static function AutoLogout() {
		if(self::LoggedIn() && !isset($_COOKIE['sbb_LoginHash'])) {
			mysql::Select('sessions', 'Time', 'LoginHash = \''.session::Read('LoginHash').'\'');					
			if((time() + 10 * 6) - mysql::FetchObject()->Time > 600) 
				header('Location: ?page=Logout');
			else {
				$Update = array('Time' => time());
				mysql::Update('sessions', $Update, 'LoginHash = \''.session::Read('LoginHash').'\'');
			}
		}	
	}
	
	public function GetMSG() {
		return $this->MSG;	
	}
	
	// Hash Stuff
	private function GenLoginHash() {
		$Hash = array_merge(range('a', 'z'), range(1, 9));
		shuffle($Hash);
		foreach($Hash as $Gen){
			$Output .= $Gen;	
		}
		return substr($Output, 0, 20).$this->UserID;	
	}
	
	private static function GetUserID() {
		return substr($_COOKIE['sbb_LoginHash'], 20);
	}
}
?>