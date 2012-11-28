<?php
/**
 * @author     Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class Post {

	const GIVEN_ID = 1;
	const GIVEN_ROW = 2;

	/**
	 * ID of this post
	 * @var int
	 */
	private $Id = 0;

	/**
	 * ID of the thread this post is in
	 * @var int
	 */
	private $ThreadId = 0;

	/**
	 * Object of the thread this post is in
	 * @var Thread
	 */
	private $Thread = null;

	/**
	 * ID of the creator
	 * @var int
	 */
	private $UserId = 0;

	/**
	 * Object of the creator
	 * @var User
	 */
	private $User = null;

	/**
	 * Subject of this post
	 * @var string
	 */
	private $Subject = '';

	/**
	 * Message of this post
	 * @var string
	 */
	private $Message = '';

	/**
	 * Time of creation
	 * @var int
	 */
	private $Time = 0;

	/**
	 * Time of last edit
	 * @var int
	 */
	private $LastEdit = 0;

	/**
	 * ID of the editor
	 * @var int
	 */
	private $EditorId = 0;

	/**
	 * Object of the editor
	 * @var User
	 */
	private $Editor = null;

	/**
	 * Poll ID
	 * @var int
	 */
	private $PollId = 0;

	/**
	 * Object of the poll
	 * @var Poll
	 */
	private $Poll = null; // TODO: Make a poll class

	/**
	 * IP address of the creator
	 * @var string
	 */
	private $IpAddress = '';

	/**
	 * Is this post disabled?
	 * @var bool
	 */
	private $Disabled = false;

	/**
	 * Is this post closed?
	 * @var bool
	 */
	private $Closed = false;

	/**
	 * Is this post deleted?
	 * @var bool
	 */
	private $Deleted = false;

	/**
	 * Reason for deletion
	 * @var string
	 */
	private $DeleteReason = '';

	/**
	 * Time of deletion
	 * @var int
	 */
	private $DeleteTime = 0;

	/**
	 * Smileys enabled?
	 * @var bool
	 */
	private $Smileys = false;

	/**
	 * HTML enabled?
	 * @var bool
	 */
	private $Html = false;

	/**
	 * SilexCode (Markdown) enabled?
	 * @var bool
	 */
	private $SilexCode = false;


	/**
	 * Create a new post object
	 * @param int $Type
	 * @param mixed $Input Row or ID of the post
	 */
	public function __construct(int $Type, $Input) {

		switch($Type) {

			case self::GIVEN_ID:
				$this->Id = (int) $Input;
				$this->Fetch();
				break;

			case self::GIVEN_ROW:
				$this->FetchRow($Input);
				break;

		}

	}

	/**
	 * Fetch by given ID
	 */
	private function Fetch() {

		$Query = SBB::DB()->prepare('SELECT * FROM `thread` WHERE `ID` = :ID');
		$Query->execute([':ID' => $this->Id]);

		$this->FetchRow($Query->fetch(PDO::FETCH_OBJ));

	}

	/**
	 * Fetch by given row from DB
	 * @param stdClass $Row
	 */
	private function FetchRow(stdClass $Row) {

		if($this->Id != 0)
			$this->Id = $Row->ID;

		// Split it up and save
		$this->ThreadId = $Row->ThreadID;
		$this->UserId = $Row->UserID;
		$this->Subject = htmlspecialchars($Row->Subject);
		$this->Message = htmlspecialchars($Row->Message); // TODO: Parse somehow (markdown?). Just specialchars for now
		$this->Time = $Row->Time;
		$this->LastEdit = $Row->LastEdit;
		$this->EditorId = $Row->EditorID;
		$this->PollId = $Row->PollID;
		$this->IpAddress = $Row->IPAddress;
		$this->Disabled = ($Row->Disabled == 1);
		$this->Closed = ($Row->Closed == 1);
		$this->Deleted = ($Row->Deleted == 1);
		$this->DeleteReason = htmlspecialchars($Row->DeleteReason);
		$this->DeleteTime = $Row->DeleteTime;
		$this->Smileys = ($Row->Smileys == 1);
		$this->Html = ($Row->HTML == 1);
		$this->SilexCode = ($Row->SilexCode == 1);

	}

	/**
	 * Save everything to the DB
	 */
	public function Save() {

		$Query = SBB::DB()->prepare('UPDATE `post`
			SET
				`ThreadID` = :ThreadID,
				`UserID` = :UserID,
				`Subject` = \':Subject\',
				`Message` = \':Message\',
				`Time` = :Time,
				`LastEdit` = :LastEdit,
				`EditorID` = :EditorID,
				`PollID` = :PollID,
				`IPAddress` = \':IPAddress\',
				`Disabled` = :Disabled,
				`Closed` = :Closed,
				`Deleted` = :Deleted,
				`DeleteReason` = \':DeleteReason\',
				`DeleteTime` = :DeleteTime,
				`Smileys` = :Smileys,
				`HTML` = :HTML,
				`SilexCode` = :SilexCode
			WHERE `ID` = :ID');

		return $Query->execute([
			':ThreadID' => $this->ThreadId,
			':UserID' => $this->UserId,
			':Subject' => $this->Subject,
			':Message' => $this->Message,
			':Time' => $this->Time,
			':LastEdit' => $this->LastEdit,
			':EditorID' => $this->EditorId,
			':PollID' => $this->PollId,
			':IPAddress' => $this->IpAddress,
			':Disabled' => ($this->Disabled ? '1' : '0'),
			':Closed' => ($this->Closed ? '1' : '0'),
			':Deleted' => ($this->Deleted ? '1' : '0'),
			':DeleteReason' => $this->DeleteReason,
			':DeleteTime' => $this->DeleteTime,
			':Smileys' => ($this->Smileys ? '1' : '0'),
			':HTML' => ($this->HTML ? '1' : '0'),
			':SilexCode' => ($this->SilexCode ? '1' : '0'),
			':ID' => $this->Id
		]);

	}
	
	/*
	 * ###### GETTERS ######
	 */

	/**
	 * @return boolean
	 */
	public function GetClosed() {
		return $this->Closed;
	}

	/**
	 * @return boolean
	 */
	public function GetDeleted() {
		return $this->Deleted;
	}

	/**
	 * @return string
	 */
	public function GetDeleteReason() {
		return $this->DeleteReason;
	}

	/**
	 * @return int
	 */
	public function GetDeleteTime() {
		return $this->DeleteTime;
	}

	/**
	 * @return boolean
	 */
	public function GetDisabled() {
		return $this->Disabled;
	}

	/**
	 * @return \User
	 */
	public function GetEditor() {
		//if($this->Editor == null)
		//	$this->Editor = new User($this->EditorId); TODO: Make an user class in this style
		return $this->Editor;
	}

	/**
	 * @return boolean
	 */
	public function GetHtml() {
		return $this->Html;
	}

	/**
	 * @return int
	 */
	public function GetId() {
		return $this->Id;
	}

	/**
	 * @return string
	 */
	public function GetIpAddress() {
		return $this->IpAddress;
	}

	/**
	 * @return int
	 */
	public function GetLastEdit() {
		return $this->LastEdit;
	}

	/**
	 * @return string
	 */
	public function GetMessage() {
		return $this->Message;
	}

	/**
	 * @return \Poll
	 */
	public function GetPoll() {
		return $this->Poll;
	}

	/**
	 * @return boolean
	 */
	public function GetSilexCode() {
		return $this->SilexCode;
	}

	/**
	 * @return boolean
	 */
	public function GetSmileys() {
		return $this->Smileys;
	}

	/**
	 * @return string
	 */
	public function GetSubject() {
		return $this->Subject;
	}

	/**
	 * @return \Thread
	 */
	public function GetThread() {
		if($this->Thread == null)
			$this->Thread = new Thread($this->ThreadId);
		return $this->Thread;
	}

	/**
	 * @return int
	 */
	public function GetTime() {
		return $this->Time;
	}

	/**
	 * @return \User
	 */
	public function GetUser() {
		//if($this->User == null)
		//	$this->User = new User($this->UserId); TODO: Make an user class in this style
		return $this->User;
	}
	
	/*
	 * ##### SETTERS ######
	 */

	/**
	 * @param boolean $Closed
	 */
	public function SetClosed($Closed) {
		$this->Closed = $Closed;
	}

	/**
	 * @param boolean $Deleted
	 */
	public function SetDeleted($Deleted) {
		$this->Deleted = $Deleted;
	}

	/**
	 * @param string $DeleteReason
	 */
	public function SetDeleteReason($DeleteReason) {
		$this->DeleteReason = $DeleteReason;
	}

	/**
	 * @param int $DeleteTime
	 */
	public function SetDeleteTime($DeleteTime) {
		$this->DeleteTime = $DeleteTime;
	}

	/**
	 * @param boolean $Disabled
	 */
	public function SetDisabled($Disabled) {
		$this->Disabled = $Disabled;
	}

	/**
	 * @param int $EditorId
	 */
	public function SetEditorId($EditorId) {
		$this->EditorId = $EditorId;
		$this->Editor = null;
	}

	/**
	 * @param boolean $Html
	 */
	public function SetHtml($Html) {
		$this->Html = $Html;
	}

	/**
	 * @param string $IpAddress
	 */
	public function SetIpAddress($IpAddress) {
		$this->IpAddress = $IpAddress;
	}

	/**
	 * @param int $LastEdit
	 */
	public function SetLastEdit($LastEdit) {
		$this->LastEdit = $LastEdit;
	}

	/**
	 * @param string $Message
	 */
	public function SetMessage($Message) {
		$this->Message = $Message;
	}

	/**
	 * @param int $PollId
	 */
	public function SetPollId($PollId) {
		$this->PollId = $PollId;
		$this->Poll = null;
	}

	/**
	 * @param boolean $SilexCode
	 */
	public function SetSilexCode($SilexCode) {
		$this->SilexCode = $SilexCode;
	}

	/**
	 * @param boolean $Smileys
	 */
	public function SetSmileys($Smileys) {
		$this->Smileys = $Smileys;
	}

	/**
	 * @param string $Subject
	 */
	public function SetSubject($Subject) {
		$this->Subject = $Subject;
	}

	/**
	 * @param int $ThreadId
	 */
	public function SetThreadId($ThreadId) {
		$this->ThreadId = $ThreadId;
		$this->Thread = null;
	}

	/**
	 * @param int $Time
	 */
	public function SetTime($Time) {
		$this->Time = $Time;
	}

	/**
	 * @param int $UserId
	 */
	public function SetUserId($UserId) {
		$this->UserId = $UserId;
		$this->User = null;
	}

}