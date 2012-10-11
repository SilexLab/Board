<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class ThreadPage implements PageData {
	protected $Link;
	protected $Info = [];
	protected $Title;

	public function __construct() {
		$this->Link = URI::Make(['page' => 'Thread']);
	}

	public function Display(Page $P) {
		Breadcrumb::Add(Language::Get('sbb.page.forum'), $P->Link('Board'));

		$ThreadID = (int)URI::Get('ThreadID', 0);
		if($ThreadID > 0 && Database::Count('FROM `thread` WHERE `ID` = :ID', [':ID' => $ThreadID])) {
			$Thread = SBB::DB()->prepare('SELECT * FROM `thread` WHERE `ID` = :ID');
			$Thread->execute([':ID' => $ThreadID]);
			$Thread = $Thread->fetch(PDO::FETCH_OBJ);

			$this->Title = $Thread->Topic;

			$Crumbs = $this->GetBreadcrumbs($Thread->BoardID);
			foreach($Crumbs as $Crumb)
				Breadcrumb::Add($Crumb['Title'], $Crumb['Link']);
			Breadcrumb::Add($this->Title, URI::Make(['page' => 'Thread', 'ThreadID' => $ThreadID]));

			SBB::Template()->Assign(['Posts' => $this->GetPosts($ThreadID)]);
		} else {
			$this->Info['title'] = Language::Get('sbb.error');
			Notification::Show('Thread existiert nicht!', Notification::ERROR);
		}
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return $this->Title;
	}

	public function Template() {
		return 'pages/Thread.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetPosts($ThreadID) {
		$Posts = SBB::DB()->prepare('SELECT * FROM `post` WHERE `ThreadID` = :ThreadID ORDER BY `ID`');
		$Posts->execute([':ThreadID' => $ThreadID]);
		$Posts = $Posts->fetchAll(PDO::FETCH_OBJ);

		$PostList = [];
		foreach($Posts as $P) {
			$User = SBB::DB()->prepare('SELECT * FROM `users` WHERE `ID` = :UserID');
			$User->execute([':UserID' => $P->UserID]);
			$User = $User->fetch(PDO::FETCH_OBJ);

			$PostList[] = [
				'Subject' => $P->Subject,
				'Message' => $P->Message,
				'Time'    => date('d.m.Y, h:i', $P->Time),
				'User'    => [
					'Name' => htmlspecialchars($User->Username),
					'Link' => URI::Make(['page' => 'User', 'UserID' => $User->ID])
				]
			];
		}
		return $PostList;
	}

	protected function GetBreadcrumbs($BoardID) { // Duplicate form BoardPage
		$Board = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ID` = :BoardID');
		$Board->execute([':BoardID' => $BoardID]);
		$Board = $Board->fetch(PDO::FETCH_OBJ);		

		$Crumbs = array();
		if($Board->ParentID != 0)
			$Crumbs = $this->GetBreadcrumbs($Board->ParentID);
		$Crumbs[] = array('Title' => htmlspecialchars($Board->Title), 'Link' => $Board->Type == 2 ? htmlspecialchars($Board->Link) : URI::Make(['page' => 'Board', 'BoardID' => $Board->ID]));
		return $Crumbs;
	}
}
?>