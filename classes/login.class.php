<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 7
 */

class login {
	
	private static $UserId;
	private static $AllwaysLogged;
	protected static $Msg = '';
	
	// CheckUser zum Usercheck ob er da is usw.
	public function __construct($Name, $Pass, $AllwaysLogged) {
				
		// magic quotes anpassen
		if (get_magic_quotes_gpc()) {
			$Name = stripslashes($Name);
			$Pass = stripslashes($Pass);
		}
		// escapen von \x00, \n, \r, \, ', " und \x1a
		$Name = mysql_real_escape_string($Name);
		
		// escapen von % und _
		$Name = str_replace('%', '\%', $Name);
		$Name = str_replace('_', '\_', $Name);
		
		// Prüft ob Name und Password stimmen
		mysql::Select('users', 'Salt', 'UserName = \''.$Name.'\'', '', 1);
		if($Row = mysql::NumRows() == 1) {
			$Salt = mysql::FetchObject()->Salt;
			mysql::Select('users', 'ID', 'UserName = \''.$Name.'\' AND Password = \''.sha1($Salt.md5($Salt.sha1($Pass.md5($Salt)))).'\'');
		}
		
		// Gibt UserId aus
		if($Row = mysql::NumRows() == 1) {
			$User = $Row = mysql::FetchObject();
			self::$UserId = $User->ID;
			self::$AllwaysLogged = $AllwaysLogged;
			self::DoLogin();
			self::$Msg = '<p>{lang=com.sbb.login.redirect}</p>
			<p>{lang=com.sbb.login.ifnotredirect}<a href="./">Link</a></p>
			<script type="text/javascript">
				window.setTimeout("window.location.href=\'./\'",2000);
			</script>';			// TO-DO: JavaScript auslagern
		} else {
			self::$Msg = '{lang=com.sbb.login.wrongdata}';
			self::$UserId = false;
		}
	}
	
	// Session setzten und Daten in die DB schreiben
	public static function DoLogin() {
		if(self::$AllwaysLogged == true) {
			session::Set('userid', self::$UserId);
			$Str = session_id();
			setcookie('sbb_loginHash', md5($Str.sha1($Str)), time()+60*60*24*365);
			$Inserts = array('Time' => time(),
					'UserID' => $UserID,
					'Salt' => md5($Str.sha1($Str)),
					'IP' => $_SERVER['REMOTE_ADDR']);
		} else {
			session::Set('userid', self::$UserId);
			$Inserts = array('Time' => time(),
					'UserID' => $UserID,
					'Salt' => session_id(),
					'IP' => $_SERVER['REMOTE_ADDR']);
		}
		mysql::Insert('sessions', $Inserts);
	}
	
	public static function GetMsg() {
		return self::$Msg;
	}
	
	// Wenn LoggedIn dann wird eingeloggte Bereich gezeigt
	public static function LoggedIn() {
		if(isset($_COOKIE['sbb_loginHash'])) {
			mysql::Select('sessions', 'UserID', 'Salt = \''.$_COOKIE['sbb_loginHash'].'\'');
			return (mysql::NumRows() == 1);
		} else {
			mysql::Select('sessions', 'UserID', 'Salt = \''.session_id().'\'');
			return (mysql::NumRows() == 1);
		}
	}
	
	// Beim ausloggen wird alles gelöscht
	public static function DoLogout() {
		mysql::Delete('sessions', 'Salt = \''.session_id().'\'');
		mysql::Delete('sessions', 'Salt = \''.$_COOKIE['sbb_loginHash'].'\'');
		session::Remove('userid');
		setcookie('sbb_loginHash', '', time()-60*60*24*365);
	}
	
	// After 10 minutes you will automatically logged out
	public static function AutoLogout() {
		if(login::LoggedIn() && !isset($_COOKIE['sbb_loginHash'])) {
			mysql::Select('sessions', 'Time', 'Salt=\''.session_id().'\'');		
			$TimeFuture = time() + 10 * 6;
			while($Row = mysql::FetchArray()) {
				$LastTime = $Row['Time'];
			}
			if($TimeFuture - $LastTime > 600) {
				header('Location: ?page=Logout');
			} else {
				$Update = array('Time' => time());
				mysql::Update('sessions', $Update, 'Salt=\''.session_id().'\'');
			}
		}	
	}

	// Gibt Username aus
	public static function GetUsername ($UserID) {
		if(Login::LoggedIn() == 1) {
			$Username = mysql::FetchObject(mysql::Select('users','*','`ID`='.$UserID))->UserName;
			return($Username);
		}
		else
			return false;
	}
	
}
?>