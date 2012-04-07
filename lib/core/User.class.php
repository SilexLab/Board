<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class User {
	protected $Name, $ID, $LoggedIn;
	protected $Info = array();
	protected $Permission = array();

	public function __construct() {
		if(Session::Get('UserID')) { // User seems to be logged in
			$Result = SBB::DB()->Table('users')->Select('*')->Where('`ID` = '.Session::Get('UserID'))->Execute();
			if(!$Result) {
				// Do Logout
				Session::Remove('UserID');
				Session::Destroy();
				$this->__construct();
			} else { // User is logged in
				$UserInfo = SBB::DB()->FetchObjects();
				$this->Name = $UserInfo->Username;
				$this->ID = $UserInfo->ID;
				$this->LoggedIn = true;
			}
		} else { // Not logged in
			$this->Name = Language::Get('com.sbb.user.guest');
			$this->ID = 0;
			$this->LoggedIn = false;
		}
		SBB::Template()->Set(array('User' => array('ID' => $this->ID, 'Name' => $this->Name)));
	}

	/* User info */

	/**
	 * Return the user name or set it
	 */
	public function Name($Name = '') {
		if(empty($Name))
			return $this->Name;
		// TODO: Set the name
	}

	/**
	 * Returns the user id of the current user
	 * @return int
	 */
	public function ID() {
		return $this->ID;
	}

	/**
	 * Get the user permission
	 * @param  string $Node
	 * @return mixed
	 */
	public function Permission($Node) {
		return isset($this->Permission[$Node]) ? $this->Permission[$Node] : null;
	}

	/**
	 * Return if the user is logged in
	 * @return bool
	 */
	public function LoggedIn() {
		return $this->LoggedIn;
	}

	/**
	 * Return additional info
	 * @param  string $Info
	 * @return mixed
	 */
	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : null;
	}

	/* User actions */

	/**
	 * Login the current user
	 * @param string $Username
	 * @param string $Password
	 * @param bool   $Stay
	 */
	public function Login($Username, $Password, $Stay) {
		$Username = EscapeString($Username);
		$Password = EscapeString($Password);
		if(SBB::DB()->Table('users')->Exists()->Where('`Username` = \''.$Username.'\'')->Execute()) {
<<<<<<< .mine			$Row = SBB::DB()->Table('users')->Select('`ID`, `Password`, `Salt`')->Where('`Username` = \''.$Username.'\'')->Limit(1)->Execute()->FetchArray();
			if(Secure::EncryptPassword($Password, $Row['Salt']) == $Row['Password']) {
				Notification::Show(Language::Get('com.sbb.login.success'), Notification::SUCCESS);
				Session::Set('UserID', $Row['ID']);
			} else {
				Session::Set('LoginError', Language::Get('com.sbb.login.failed'));
			}
=======			Notification::Show('Benutzer Existiert', Notification::SUCCESS);
>>>>>>> .theirs		} else {
			Session::Set('LoginError', Language::Get('com.sbb.login.failed'));
			#header('location: ?page=Login'); // BUG: Sessionvalue is NULL?
		}
	}

	public function Logout() {
		// Logout the user
	}

	public function Register() {
		// Register a new user
	}

	/* All user info */
	public static function GetName($ID = null) {
		if(is_null($ID)) {
			if(SBB::User()->LoggedIn())
				$ID = Session::Get('UserID');
			else
				return 'Gast';
		}
		return SBB::DB()->Table('users')->Select('`Username`')->Where('`ID` = \''.$ID.'\'')->Limit(1)->Execute()->FetchObject()->Username;
	}

	public static function GetID($Name) {
		// Get the user ID
	}
}
?>