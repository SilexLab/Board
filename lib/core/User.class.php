<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard
 */

/* Diese Klasse verwaltet und gibt informationen über die Benutzer des Boards */
class User {		
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
		SBB::SQL()->Table('users')->Insert($Inserts)->Execute();
	}
	
	public static function CheckUpdate(array $Post) {
		$Error = array();
		if(!preg_match('/^https?\:\/\/[\w\.-]+\.[\w]{2,3}$/', $Post['Homepage'])) {
			$Error[] = Language::Get('com.sbb.profile.invalid_homepage');
		}
		if(strlen($Post['Signature'] > 500)) {
			$Error[] = Language::Get('com.sbb.profile.signaturelength');
		}
		
		if(count($Error) != 0) {
			return $Error;
		}
		return true;
	}
	
	public static function Update($Property, $Value = NULL, $ID = 0) {
		if(!is_int($ID)) {
			return false;
		}
		if($ID == 0) {
			$ID = self::GetUserID();
		}
		if(is_array($Property)) {
			SBB::SQL()->Table('users')->Update($Property)->Where('`ID` = '.$ID)->Execute();
		}
		else if(!is_string($Property)) {
			SBB::SQL()->Table('users')->Update(array($Property => $Value))->Where('`ID` = '.$ID)->Execute();
		}
		else {
			return false;
		}
	}
	
	public static function GetUserID($Name = '') {
		if(!is_string($Name)) {
			return false;
		}
		if(!empty($Name)) {
			SBB::SQL()->Table('users')->Select('ID')->Where('`Username` = \''.$Name.'\'')->Limit(1)->Execute();
			return SBB::SQL()->FetchObject()->ID;
		}
		//$ID = Session::Read('UserID'); // SESCLEAR
		return $ID !== false ? $ID : 0;
	}
	
	public static function Get($Data = '*', $ID = 0) {
		if(!is_int($ID)) {
			return false;
		}
		if($ID == 0) {
			//$ID = Session::Read('UserID'); // SESCLEAR
		}
		if($ID != 0) {
			if($Data = '*') {
				SBB::SQL()->Table('users')->Select('*')->Where('`ID` = '.$ID)->Limit(1)->Execute();
				$Data = SBB::SQL()->FetchObject();	
				return $Data;	
			}
			SBB::SQL()->Table('users')->Select($Data)->Where('`ID` = '.$ID)->Limit(1)->Execute();
			$Data = SBB::SQL()->FetchObject()->$Data;	
			return $Data;
		}
		return false;
	}
	
	public static function LoggedIn() {
		//return Session::Read('UserID') > 0; // SESCLEAR
	}
	
	public static function Login($UserID, $StayLoggedIn = false) {
		/*$Token = sha1(md5(mt_rand()).microtime().mt_rand());
		$Inserts = array(
			'ID' => session_id(),
			'UserID' => $UserID,
			'IPAddress' => $_SERVER['REMOTE_ADDR'],
			'UserAgent' => $_SERVER['HTTP_USER_AGENT'],
			'LastActivityTime' => time(),
			'Token' => $Token,
			'LoginHash' => 'NULL'
		);
		SBB::SQL()->Table('session')->Insert($Inserts)->Execute();
		if($StayLoggedIn) {
			$LoginHash = sha1(mt_rand().microtime().md5(mt_rand()));
			setcookie('sbb_LoginHash', $LoginHash, time()+60*60*24*365*10);
			SBB::SQL()->Update(array('LoginHash' => $LoginHash))->Where('`UserID` = \''.$UserID.'\'')->Execute();
		}
		SBB::SQL()->Table('users')->Select('Username')->Where('`ID` = \''.$UserID.'\'')->Limit(1)->Execute();
		$row = SBB::SQL()->FetchArray();
		Session::Set('UserID', $UserID);
		Session::Set('Username', $row['Username']);*/
		// SESCLEAR
	}
	
	public static function Logout() {
		/*if(self::LoggedIn()) {
			if(isset($_COOKIE['sbb_LoginHash'])) {
				setcookie('sbb_LoginHash', '', time()-60*60);
			}
			SBB::SQL()->Table('session')->Delete()->Where('`UserID` = \''.Session::Read('UserID').'\'')->Execute();
			$_SESSION = array();
			session_destroy();
		}
		else {
			new MessageBox(Language::Get('com.sbb.logout.not_logged_in'), MessageBox::ERROR);
		}*/
		// SESCLEAR
	}
	
	// Password Stuff
	public static function EncryptPassword($Password, $Salt) {
		return sha1($Salt.md5($Salt.sha1($Password.md5($Salt))));
	}
	
	private static function EncryptSalt() {
		return sha1(md5(base64_encode(microtime())));
	}
}
?>