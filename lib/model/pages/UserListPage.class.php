<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserListPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'UserList']]);
	}

	public function Display(Page $P) {
		SBB::Nav()->Crumb()->Add(Language::Get('page.userlist'), $this->Link());

		$TempUsers = SBB::DB()->query('SELECT * FROM `users`')->fetchAll(PDO::FETCH_OBJ);
		$Users = [];
		foreach($TempUsers as $User) {
			$Users[] = [
				'name'     => htmlspecialchars($User->Username),
				'link'     => URI::Make([['page', 'User'], ['UserID', $User->ID, $User->Username]]),
				'group'    => '',
				'joined_d' => date('d. ', $User->Joined).Language::Get(TimeUtil::Month(date('n', $User->Joined))).date(' Y', $User->Joined),
				'joined_t' => date('H:i', $User->Joined),
				'posts'    => '-',
				'language' => $User->Language,
				'homepage' => $User->Homepage
			];
		}

		SBB::Template()->Assign(['users' => $Users]);
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return Language::Get('page.userlist');
	}

	public function Template() {
		return 'PageUserList.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
