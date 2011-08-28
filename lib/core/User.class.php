<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

/* Diese Klasse verwaltet und gibt informationen über die Benutzer des Boards */
class User {
	private static $Permissions = array(); // Alle Extra Berechtigungen die der Benutzer hat
	private static $UserID;
	private static $GroupID;
	private static $IsLoggedIn;
	
	public static function Initial() {
		self::$UserID = session::Read('userid');
		self::$IsLoggedIn = SBB::SQL()->RowExists('sessions', NULL, 'ID=\''.self::$UserID.'\'');
	}
	
	public static function Create($Username, $Password, $Email) {
		$Salt = self::EncryptSalt();
		$Password = self::EncryptPassword($Password, $Salt);
		$Key = substr(md5(base64_encode($Password.$Salt)), 0, 15);
		
		$Inserts = array('UserName' => $Username,
				'Password' => $Password,
				'Salt' => $Salt,
				'Email' => $Email,
				'ActivationKey' => $Key,
				'RegisterTime' => time(),
				/*'Activated' => 0 Funktioniert nicht*/);
		SBB::SQL()->Insert('users', $Inserts);
		
		//self::sendActivationMail($email, $key);
	}
	
	public static function sendActivationMail($email, $key) {
		$FolderBase = $_SERVER['SCRIPT_NAME'];
		$FolderBase = explode(basename($_SERVER['PHP_SELF']),$_SERVER['PHP_SELF']);
		$FolderBase = $FolderBase[0];

		$url =  'http://'.$_SERVER['SERVER_NAME'].$FolderBase.'index.php?page=Activation&key='.$key;
		Template::Assign('ActivationURL', $url);
		
		// Only Englich? WTF!
		$subject = "Silex Bulletin Board - Activation";
		Template::Display('emailActivation.tpl');
		
		// Allow Mail To Use HTML
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional Header | TODO: You Config-File For This To Choose A Own Name And Email
		$header .= 'From: Silex Bulletin Board <support@silexboard.org>' . "\r\n";
		
		mail($email, $subject, $message, $header);
	}
	
	public static function sendPWForgetMail($email, $key) {
		$FolderBase = $_SERVER['SCRIPT_NAME'];
		$FolderBase = explode(basename($_SERVER['PHP_SELF']),$_SERVER['PHP_SELF']);
		$FolderBase = $FolderBase[0];

		$pw = self::genPW(6);		
		$url = 'http://'.$_SERVER['SERVER_NAME'].$FolderBase.'index.php?page=PWForget&key='.$key;
		$tpl = new template('emailPWForget');	
		
		$subject = "PWForget";
		$message = $tpl->Display();
		
		// Allow Mail To Use HTML
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional Header
		$header .= 'From: Silex Bulletin Board <support@silexboard.org>' . "\r\n";
		
		mail($email, $subject, $message, $header);
	}
	
	public static function genPW($length) {
		$pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$pool .= "abcdefghijklmnopqrstuvwxyz";
		$pool .= "1234567890";
		
		$password="";
		for ($i = 0; $i < $length; $i++) {
			$password .= $pool{rand(0, strlen($pool)-1)};
		}
		
		return $password;		
	}
	
	public static function Delete($ID) {
		if($ID = 0) {
			$ID = Session::Get('UserID');
		}
		if(!is_int($ID)) {
			return false;
		}
		SBB::SQL()->Delete('users', $ID);
		return true;
	}
	
	public static function Update($ID, $Property, $Value = NULL) {
		if($ID = 0) {
			$ID = Session::Get('UserID');
		}
		if(!is_int($ID)) {
			return false;
		}
		if(is_array($Property))
			SBB::SQL()->Update('users', $Property, 'ID = '.$ID);
		else if(!is_string($Property))
			SBB::SQL()->Update('users', array($Property => $Value), 'ID = '.$ID);
		else
			return false;
	}
	
	public static function GetUserID($Name) {
		if(!is_string($Name))
			return false;
		SBB::SQL()->Select('users', 'ID', 'Username=\''.$Name.'\'');
		return SBB::SQL()->GetObjects()->ID;
	}
	
	public static function GetUsername($ID = 0) {
		if($ID = 0) {
			$ID = Session::Get('UserID');
		}
		if(!is_int($ID)) {
			return false;
		}
		SBB::SQL()->Select('users', 'Username', 'ID = '.$ID);
		$UserName = SBB::SQL()->FetchObject()->Username;	
		return $UserName;
	}
	
	public static function GetEmail($ID) {
		if($ID = 0) {
			$ID = Session::Get('UserID');
		}
		if(!is_int($ID)) {
			return false;
		}
		SBB::SQL()->Select('users','*','ID='.$ID);
		$Email = SBB::SQL()->FetchObject()->Email;	
		return $Email;
	}
	
	public static function LoggedIn() {
		return self::$IsLoggedIn;
	}
	
	public static function Login($UserID, $StayLoggedIn = 0) {
		$Token = sha1(mt_rand(0, mt_getrandmax()).microtime(true).mt_rand(0, mt_getrandmax()));
		Session::Set('UserID', $UserID);
		if(!$StayLoggedIn) {
			Session::Set('Token', $Token);
		}
		else {
			setcookie('sbb_Token', $Token, time()+60*60*24*365);
		}
		$Inserts = array('UserID' => $UserID,
			'Username' => self::GetUsername($UserID),
			'IPAddress' => $_SERVER['REMOTE_ADDR'],
			'UserAgent' => $_SERVER['HTTP_USER_AGENT'],
			'LastActivityTime' => time(),
			'Token' => $Token);
		
		SBB::SQL()->Insert('session', $Inserts);
	}
	
	public static function Logout() {
		SBB::SQL()->Delete('session', 'Token = \''.$_COOKIE['sbb_Token'].'\'');
		SBB::SQL()->Delete('session', 'Token = \''.Session::Read('Token').'\'');
		Session::Remove('UserID');
		Session::Remove('Token');
		setcookie('sbb_Token', '', time()-60*60*24*365);
	}
	
	// Password Stuff
	public static function EncryptPassword($Password, $Salt) {
		return sha1($Salt.md5($Salt.sha1($Password.md5($Salt))));
	}
	
	private static function EncryptSalt() {
		return sha1(md5(base64_encode(microtime())));
	}
	
	public static function Email($Subject, $Message, $UserID, $Headers = '') {
		$Email = self::GetEmail($UserID);
		mail($Email, $Subject, $Message, $Headers);
	}
}
?>