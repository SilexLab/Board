<?php
/**
 * @author     Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class Thread {

	const GIVEN_ID = 1;
	const GIVEN_ROW = 2;

	/**
	 * ID of the thread
	 * @var int
	 */
	protected $Id = 0;

	/**
	 * Parent board ID
	 * @var int
	 */
	protected $BoardId = 0;

	/**
	 * Board object
	 * @var Board
	 */
	protected $Board = null;

	/**
	 * ID of the first post
	 * @var int
	 */
	protected $PostId = 0;

	/**
	 * First post object
	 * @var Post
	 */
	protected $Post = null;

	/**
	 * Creator ID
	 * @var int
	 */
	protected $UserId = 0;

	/**
	 * Creator object
	 * @var User
	 */
	protected $User = null;

	/**
	 * Prefix of this thread
	 * @var string
	 */
	protected $Prefix = '';

	/**
	 * Topic of this thread
	 * @var string
	 */
	protected $Topic = '';

	/**
	 * First message, shortened
	 * @var string
	 */
	protected $Message = '';

	/**
	 * Time of creation
	 * @var int
	 */
	protected $Time = 0;

	/**
	 * ID of the last post
	 * @var int
	 */
	protected $LastPostId = 0;

	/**
	 * Last post object
	 * @var Post
	 */
	protected $LastPost = null;

	/**
	 * Time of the last post.
	 * @var int
	 */
	protected $LastPostTime = 0;

	/**
	 * Number of replies
	 * @var int
	 */
	protected $Replies = 0;

	/**
	 * Number of views
	 * @var int
	 */
	protected $Views = 0;

	/**
	 * Is this thread sticky?
	 * @var bool
	 */
	protected $Sticky = false;

	/**
	 * Is this thread disabled
	 * @var bool
	 */
	protected $Disabled = false;

	/**
	 * Is this thread closed?
	 * @var bool
	 */
	protected $Closed = false;

	/**
	 * Is this thread deleted?
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
	 * Buffer for GetPosts
	 * @var array
	 */
	protected $Posts = [];

	/**
	 * Link to this Thread
	 * @var string
	 */
	protected $Link = '';

	/**
	 * Create a new thread object
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

		$Query = SBB::DB()->prepare('SELECT * FROM `thread` WHERE `ID` = :ID');
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

		$this->BoardId = $Row->BoardID;
		$this->PostId = $Row->PostID;
		$this->UserId = $Row->UserID;
		$this->Prefix = $Row->Prefix;
		$this->Topic = $Row->Topic;
		$this->Message = $Row->Message;
		$this->Time = $Row->Time;
		$this->LastPostId = $Row->LastPostID;
		$this->LastPostTime = $Row->LastPostTime;
		$this->Replies = $Row->Replies;
		$this->Views = $Row->Views;
		$this->Sticky = ($Row->Sticky == 1);
		$this->Disabled = ($Row->Disabled == 1);
		$this->Closed = ($Row->Closed == 1);
		$this->Deleted = ($Row->Deleted == 1);
		$this->DeleteReason = $Row->DeleteReason;
		$this->DeleteTime = $Row->DeleteTime;

	}

	/**
	 * Save everything to the DB
	 */
	public function Save() {

		$Query = SBB::DB()->prepare('UPDATE `thread`
			SET
				`BoardID` = :BoardID,
				`PostID` = :PostID,
				`UserID` = :UserID,
				`Prefix` = :Prefix,
				`Topic` = :Topic,
				`Message` = :Message,
				`Time` = :Time,
				`LastPostID` = :LastPostID,
				`LastPostTime` = :LastPostTime,
				`Replies` = :Replies,
				`Views` = :Views,
				`Sticky` = :Sticky,
				`Disabled` = :Disabled,
				`Closed` = :Closed,
				`Deleted` = :Deleted,
				`DeleteReason` = :DeleteReason,
				`DeleteTime`= :DeleteTime
			WHERE `ID` = :ID');

		return $Query->execute([
			':BoardID' => $this->BoardId,
			':PostId' => $this->PostId,
			':UserID' => $this->UserId,
			':Prefix' => $this->Prefix,
			':Topic' => $this->Topic,
			':Message' => $this->Message,
			':Time' => $this->Time,
			':LastPostID' => $this->LastPostId,
			':LastPostTime' => $this->LastPostTime,
			':Replies' => $this->Replies,
			':Views' => $this->Views,
			':Sticky' => ($this->Sticky ? '1' : '0'),
			':Disabled' => ($this->Disabled ? '1' : '0'),
			':Closed' => ($this->Closed ? '1' : '0'),
			':Deleted' => ($this->Deleted ? '1' : '0'),
			':DeleteReason' => $this->DeleteReason,
			':DeleteTime' => $this->DeleteTime
		]);

	}

	/**
	 * Fetch the posts from the DB
	 * @param int $Start [optional] Start number (not ID) of the post list
	 * @param int $End   [optional] End number (not ID) of the post list
	 * @return array
	 */
	public function GetPosts($Start = null, $End = null) {

		// Is this buffered already?
		if(!empty($this->Posts))
			return $this->Posts;

		/* Query */

		$Query = 'SELECT * FROM `post` WHERE `ThreadID` = :ID ORDER BY `ID`';
		$Vars = [':ID' => $this->Id];
		if($Start != null) {

			$Query .= ' LIMIT :Start';
			$Vars[':Start'] = $Start;

			if($End != null) {
				$Query .= ',:End';
				$Vars[':End'] = $End;
			}

		}

		$Stmt = SBB::DB()->prepare($Query);
		$Stmt->execute($Vars);

		$Data = $Stmt->fetchAll(PDO::FETCH_OBJ);

		// Our array of posts
		$Posts = [];

		/* Fetch them! */
		foreach($Data as $Row) {

			$Posts[] = new Post(Post::GIVEN_ROW, $Row);

		}

		// Save into buffer
		$this->Posts = $Posts;

		return $Posts;

	}

	public function GetBreadcrumbs() {

		return ThreadUtil::GetBreadcrumbs($this);

	}

	
	/* Getters */

	/**
	 * @return \Board
	 */
	public function GetBoard() {
		if(is_null($this->Board))
			$this->Board = new Board(Board::GIVEN_ID, $this->BoardId);

		return $this->Board;
	}

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
	 * @return int
	 */
	public function GetId() {
		return $this->Id;
	}

	/**
	 * @return \Post
	 */
	public function GetLastPost() {
		return $this->LastPost;
	}

	/**
	 * @return string
	 */
	public function GetMessage() {
		return $this->Message;
	}

	/**
	 * @return \Post
	 */
	public function GetPost() {
		return $this->Post;
	}

	/**
	 * @return string
	 */
	public function GetPrefix() {
		return $this->Prefix;
	}

	/**
	 * @return int
	 */
	public function GetReplies() {
		return $this->Replies;
	}

	/**
	 * @return boolean
	 */
	public function GetSticky() {
		return $this->Sticky;
	}

	/**
	 * @return int
	 */
	public function GetTime() {
		return $this->Time;
	}

	/**
	 * @return string
	 */
	public function GetTopic() {
		return $this->Topic;
	}

	/**
	 * @return \User
	 */
	public function GetUser() {
		return $this->User;
	}

	/**
	 * @return int
	 */
	public function GetViews() {
		return $this->Views;
	}

	/**
	 * @return int
	 */
	public function GetLastPostTime() {
		return $this->LastPostTime;
	}

	public function GetLink() {

		if($this->Link == '')
			$this->Link = URI::Make([['page', 'Thread'], ['ThreadID', $this->Id, $this->Topic]]);
		return $this->Link;

	}
	
	/* Setters */

	/**
	 * @param int $BoardId
	 */
	public function SetBoardId($BoardId) {
		$this->BoardId = $BoardId;
		$this->Board = null;
	}

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
	 * @param int $LastPostId
	 */
	public function SetLastPostId($LastPostId) {
		$this->LastPostId = $LastPostId;
		$this->LastPost = null;
	}

	/**
	 * @param string $Message
	 */
	public function SetMessage($Message) {
		$this->Message = $Message;
	}

	/**
	 * @param int $PostId
	 */
	public function SetPostId($PostId) {
		$this->PostId = $PostId;
		$this->Post = null;
	}

	/**
	 * @param string $Prefix
	 */
	public function SetPrefix($Prefix) {
		$this->Prefix = $Prefix;
	}

	/**
	 * @param int $Replies
	 */
	public function SetReplies($Replies) {
		$this->Replies = $Replies;
	}

	/**
	 * @param boolean $Sticky
	 */
	public function SetSticky($Sticky) {
		$this->Sticky = $Sticky;
	}

	/**
	 * @param int $Time
	 */
	public function SetTime($Time) {
		$this->Time = $Time;
	}

	/**
	 * @param string $Topic
	 */
	public function SetTopic($Topic) {
		$this->Topic = $Topic;
	}

	/**
	 * @param int $UserId
	 */
	public function SetUserId($UserId) {
		$this->UserId = $UserId;
		$this->User = null;
	}

	/**
	 * @param int $Views
	 */
	public function SetViews($Views) {
		$this->Views = $Views;
	}

}