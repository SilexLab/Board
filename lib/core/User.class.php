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
			$Result = SBB::DB()->prepare('SELECT * FROM `users` WHERE `ID` = :UserID');
			$Result->execute([':UserID' => Session::Get('UserID')]);
			if(!$Result) {
				// Do Logout
				Session::Destroy();
				$this->__construct();
			} else { // User is logged in
				$UserInfo = $Result->fetch(PDO::FETCH_OBJ);
				$this->Name = $UserInfo->Username;
				$this->ID = $UserInfo->ID;
				$this->LoggedIn = true;
			}
		} else { // Not logged in
			$this->Name = Language::Get('sbb.user.guest');
			$this->ID = 0;
			$this->LoggedIn = false;
		}
		SBB::Template()->assign(['User' => ['ID' => (int)$this->ID, 'Name' => $this->Name]]);
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
		$Username = $Username;
		$Password = $Password;

		if(Database::Count('FROM `users` WHERE `Username` = :User', [':User' => $Username])) {
			$Row = SBB::DB()->prepare('SELECT `ID`, `Password`, `Salt` FROM `users` WHERE `Username` = :User');
			$Row->execute([':User' => $Username]);
			$Row = $Row->fetch(PDO::FETCH_ASSOC);
			if(Secure::EncryptPassword($Password, $Row['Salt']) == $Row['Password']) {
				Notification::Show(Language::Get('sbb.login.success'), Notification::SUCCESS);
				Session::Set('UserID', $Row['ID']);
				$this->__construct();
			} else {
				Session::Set('LoginError', 'sbb.login.failed');
				header('location: '.URI::Make(['page' => 'Login']));
			}
		} else {
			Session::Set('LoginError', 'sbb.login.failed');
			header('location: '.URI::Make(['page' => 'Login']));
		}
	}

	public function Logout() {
		if($this->LoggedIn()) {
			Session::Destroy();
			Notification::Show(Language::Get('sbb.logout.success'), Notification::SUCCESS);
			$this->__construct();
		}
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
		$STMT = SBB::DB()->prepare('SELECT `Username` FROM `users` WHERE `ID` = :ID');
		$STMT->execute([':ID' => $ID]);
		return $STMT->fetch(PDO::FETCH_OBJ)->Username;
	}

	public static function GetID($Name) {
		// Get the user ID
	}
}
?>