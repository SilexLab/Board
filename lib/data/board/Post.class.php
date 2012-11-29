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
	protected $Id = 0;

	/**
	 * ID of the thread this post is in
	 * @var int
	 */
	protected $ThreadId = 0;

	/**
	 * Object of the thread this post is in
	 * @var Thread
	 */
	protected $Thread = null;

	/**
	 * ID of the creator
	 * @var int
	 */
	protected $UserId = 0;

	/**
	 * Object of the creator
	 * @var User
	 */
	protected $User = null;

	/**
	 * Subject of this post
	 * @var string
	 */
	protected $Subject = '';

	/**
	 * Message of this post
	 * @var string
	 */
	protected $Message = '';

	/**
	 * Time of creation
	 * @var int
	 */
	protected $Time = 0;

	/**
	 * Time of last edit
	 * @var int
	 */
	protected $LastEdit = 0;

	/**
	 * ID of the editor
	 * @var int
	 */
	protected $EditorId = 0;

	/**
	 * Object of the editor
	 * @var User
	 */
	protected $Editor = null;

	/**
	 * Poll ID
	 * @var int
	 */
	protected $PollId = 0;

	/**
	 * Object of the poll
	 * @var Poll
	 */
	protected $Poll = null; // TODO: Make a poll class

	/**
	 * IP address of the creator
	 * @var string
	 */
	protected $IpAddress = '';

	/**
	 * Is this post disabled?
	 * @var bool
	 */
	protected $Disabled = false;

	/**
	 * Is this post closed?
	 * @var bool
	 */
	protected $Closed = false;

	/**
	 * Is this post deleted?
	 * @var bool
	 */
	protected $Deleted = false;

	/**
	 * Reason for deletion
	 * @var string
	 */
	protected $DeleteReason = '';

	/**
	 * Time of deletion
	 * @var int
	 */
	protected $DeleteTime = 0;

	/**
	 * Smileys enabled?
	 * @var bool
	 */
	protected $Smileys = false;

	/**
	 * HTML enabled?
	 * @var bool
	 */
	protected $Html = false;

	/**
	 * SilexCode (Markdown) enabled?
	 * @var bool
	 */
	protected $SilexCode = false;


	/**
	 * Create a new post object
	 * @param int $Type
	 * @param mixed $Input Row or ID of the post
	 */
	public function __construct($Type, $Input) {

		switch($Type) {

			case self::GIVEN_ID:
				$this->Id = (int) $Input;
				if(!$this->Fetch())
					return false;
				break;

			case self::GIVEN_ROW:
				$this->FetchRow($Input);
				break;

		}

	}

	/**
	 * Fetch by given ID
	 */
	protected function Fetch() {

		$Query = SBB::DB()->prepare('SELECT * FROM `post` WHERE `ID` = :ID');
		$Query->execute([':ID' => $this->Id]);

		$Result = $Query->fetch(PDO::FETCH_OBJ);

		if(!$Result)
			return false;

		$this->FetchRow($Result);

	}

	/**
	 * Fetch by given row from DB
	 * @param stdClass $Row
	 */
	protected function FetchRow(stdClass $Row) {

		if($this->Id == 0)
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
	
	/* Getters */

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
			$this->Thread = new Thread(Thread::GIVEN_ID, $this->ThreadId);
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
		if($this->User == null)
			$this->User = new User(User::GIVEN_ID, $this->UserId);
		return $this->User;
	}
	
	/* Setters */

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