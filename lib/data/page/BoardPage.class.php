<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class BoardPage implements IPage {
	protected $Link;
	protected $Info = [];
	protected $UF;

	public function __construct() {
		$this->Link = URI::Make([['page', 'Board']]);
	}

	public function Display(Page $P) {
		Breadcrumb::Add(Language::Get('sbb.page.board'), $this->Link());
		$this->Info['title'] = Language::Get('sbb.page.board');
		
		$this->UF = $P->URI()->Format();
		$BoardID = $P->URI()->GetID(1, 'BoardID');

		// Breadcrumbs
		if($BoardID > 0) {
			// Find Breadcrumbs
			$Crumbs = $this->GetBreadcrumbs($BoardID);

			// Redirect if url-title is wrong
			if(!$P->URI()->Check(1, htmlspecialchars_decode($this->Info['title']))) {
				$Board = SBB::DB()->prepare('SELECT `Title` FROM `board` WHERE `ID` = :ID');
				$Board->execute([':ID' => $BoardID]);
				$Title = $Board->fetch(PDO::FETCH_OBJ)->Title;
				header('location: '.URI::Make([['page', 'Board'], ['BoardID', $BoardID, $Title]]));
			}

			foreach($Crumbs as $Crumb) {
				Breadcrumb::Add($Crumb['title'], $Crumb['link']);
			}
		} else if($P->URI()->GetRoute()[1]) {
			header('location: '.$this->Link);
		}
		$cBoard = SBB::DB()->prepare('SELECT `Type` FROM `board` WHERE `ID` = :ID');
		$cBoard->execute([':ID' => $BoardID]);
		SBB::Template()->Assign(['board' => $this->GetBoardList($BoardID),
			'threads' => $this->GetThreadList($BoardID),
			'current_board' => ['ID' => $BoardID, 'type' => $cBoard->fetch(PDO::FETCH_OBJ)->Type]]);
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return $this->Info['title'];
	}

	public function Template() {
		return 'PageBoard.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetBoardList($BoardID, $Depth = 0) {
		$Board = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ParentID` = :BoardID ORDER BY `Position`');
		$Board->execute([':BoardID' => $BoardID]);
		$Board = $Board->fetchAll(PDO::FETCH_OBJ);

		$Depth++;
		$BoardList = array();
		foreach($Board as $Entry) {
			$BoardList[] = [
				'type'           => $Entry->Type,
				'title'          => htmlspecialchars($Entry->Title),
				'description'    => htmlspecialchars($Entry->Description),
				'link'           => $Entry->Type == 2 ? htmlspecialchars($Entry->Link) : URI::Make([['page', 'Board'], ['BoardID', $Entry->ID, $Entry->Title]]),
				'stats'          => $Entry->Type == 2 ? ('Views: '.$Entry->Views) : ('Threads: '.$Entry->Threads.', Posts: '.$Entry->Posts.', Views: '.$Entry->Views),
				'last_post'      => 0,
				'last_post_user' => 'None',
				'sub_board'      => $Depth < 3 ? $this->GetBoardList($Entry->ID, $Depth) : false
			];
		}
		return $BoardList;
	}

	public function GetThreadList($BoardID) {
		$Threads = SBB::DB()->prepare('SELECT * FROM `thread` WHERE `BoardID` = :BoardID ORDER BY `LastPostTime` DESC'); // TODO: Limit it
		$Threads->execute([':BoardID' => $BoardID]);
		$Threads = $Threads->fetchAll(PDO::FETCH_OBJ);

		$ThreadList = array();
		foreach($Threads as $T) {
			$ThreadList[] = [
				'topic' => htmlspecialchars($T->Topic),
				'link'  => URI::Make([['page', 'Thread'], ['ThreadID', $T->ID, $T->Topic]])
			];
		}
		return $ThreadList;
	}

	public function GetBreadcrumbs($BoardID) {
		$Board = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ID` = :BoardID');
		$Board->execute([':BoardID' => $BoardID]);
		$Board = $Board->fetch(PDO::FETCH_OBJ);		

		$Crumbs = array();
		if($Board->ParentID != 0)
			$Crumbs = $this->GetBreadcrumbs($Board->ParentID);
		$Crumbs[] = array('title' => htmlspecialchars($Board->Title), 'link' => $Board->Type == 2 ? htmlspecialchars($Board->Link) : URI::Make([['page', 'Board'], ['BoardID', $Board->ID, $Board->Title]]));
		$this->Info['title'] = htmlspecialchars($Board->Title);
		return $Crumbs;
	}
}
