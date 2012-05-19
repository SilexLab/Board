<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserPage extends Page implements PageData {
	protected static $Link = ['page' => 'User'];
	protected static $Node = 'page.user';
	protected $Info = array();

	public function __construct() {
		if(!URI::Get('UserID'))
			header('location: '.UserListPage::Link());

		$this->Info['node'] = UserListPage::Node();
		$this->Info['title'] = Language::Get('sbb.page.user');
		$UserID = (int)URI::Get('UserID');
		if($UserID < 1 || !Database::Count('FROM `users` WHERE `ID` = :ID', [':ID' => $UserID])) {
			Notification::Show(Language::Get('sbb.user.no_user'), Notification::ERROR);
			$this->Info['template'] = 'Error';
			return;
		}
		
		$User = SBB::DB()->prepare('SELECT * FROM `users` WHERE `ID` = :ID');
		$User->execute([':ID' => $UserID]);
		$User = $User->fetch(PDO::FETCH_OBJ);

		$this->Info['template'] = 'User';
		$this->Info['title'] = Language::Get('sbb.user.user').': '.$User->Username;
		Breadcrumb::Add(Language::Get('sbb.page.userlist'), UserListPage::Link());
		Breadcrumb::Add($User->Username, self::$Link.'&UserID='.$UserID);

		// Template..
		SBB::Template()->Set(array('Profile' => array(
			'Username'  => $User->Username,
			'ID'        => $User->ID,
			'Group'     => $User->GroupID,   // TODO: Read group
			'Signature' => $User->Signature, // TODO: Parse message
			'Joined'    => Language::Get(Time::Day(date('N', $User->Joined))).', '.
				date('d. ', $User->Joined).Language::Get(Time::Month(date('n', $User->Joined))).
				date(' Y, H:i', $User->Joined),
			'Activity'  => date('d.m.Y, H:i', $User->LastActivity), // TODO: Alternative formats, like "Today, 11:23" or "Yesterday, 13:37",
			'Language'  => $User->Language ? $User->Language : Language::Get('sbb.language.info'), // TODO: Read the real language
			'Birthday'  => date('d.m.Y', $User->Birthday),
			'Age'       => date('md', date('U', $User->Birthday)) > date('md') ? // TODO: Find a better age calculation
				(date('Y') - date('Y', $User->Birthday)-1) :
				(date('Y') - date('Y', $User->Birthday))
		)));
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