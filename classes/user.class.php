<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 8
 */

/* Diese Klasse verwaltet und gibt informationen über die Benutzer des Boards */
class user {
	private static $Permissions = array(); // Alle Extra Berechtigungen die der Benutzer hat
	private static $UserID;
	private static $GroupID;
	private static $IsLoggedIn;
	
	public static function Initial() {
		self::$UserID = session::Read('userid');
		/*mysql::Select('sessions', 'UserID', 'UserID="'.self::$UserID.'"');
		self::$IsLoggedIn = mysql::GetObjects()->UserID == self::$UserID ? true : false;*/
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
				'RegisterTime' => time());
		mysql::Insert('users', $Inserts);
	}
	
	public static function Delete($ID) {
		if(!is_int($ID))
			return false;
		mysql::Delete('users', $ID);
		return true;
	}
	
	public static function Update($ID, $Property, $Value = NULL) {
		if(!is_int($ID))
			return false;
		if(is_array($Property))
			mysql::Update('users', $Property, 'ID='.$ID);
		else if(!is_string($Property))
			mysql::Update('users', array($Property => $Value), 'ID='.$ID);
		else
			return false;
	}
	
	public static function GetUserID($Name) {
		if(!is_string($Name))
			return false;
		mysql::Select('users', 'ID', 'UserName=\''.$Name.'\'', NULL, 1);
		return mysql::GetObjects()->ID;
	}
	
	public static function GetUsername($ID) {
		if(!is_int($ID))
			return false;
		mysql::Select('users','*','ID='.$ID);
		$UserName = mysql::FetchObject()->UserName;	
		return $UserName;
	}
	
	public static function GetEmail($ID) {
		if(!is_int($ID))
			return false;
		mysql::Select('users','*','ID='.$ID);
		$Email = mysql::FetchObject()->Email;	
		return $Email;
	}
	
	public static function LoggedIn() {
		return self::$IsLoggedIn;
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