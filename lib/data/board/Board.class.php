<?php
/**
 * @author     Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class Board {

	/*
	 * Type constants
	 */
	const TYPE_CATEGORY = 0;
	const TYPE_BOARD = 1;
	const TYPE_LINK = 2;
	
	/*
	 * What is given to fetch stuff?
	 */
	const GIVEN_ID = 1;
	const GIVEN_ROW = 2;

	/**
	 * ID of this Board
	 * @var int
	 */
	private $Id = 0;

	/**
	 * ID of the parent board. 0 for none
	 * @var int
	 */
	private $ParentId = 0;

	/**
	 * Is this a category, board or link? See Board::TYPE_* constants
	 * @var int
	 */
	private $Type = 0;

	/**
	 * Object of the parent board. null for none
	 * @var Board
	 */
	private $ParentBoard = null;

	/**
	 * Title of this board
	 * @var string
	 */
	private $Title = '';

	/**
	 * Description of this board
	 * @var string
	 */
	private $Desc = '';

	/**
	 * If this is of TYPE_LINK, the link
	 * @var string
	 */
	private $Link = '';

	/**
	 * Positioning order
	 * @var int
	 */
	private $Position = 0;

	/**
	 * Image of this board
	 * @var string
	 */
	private $Image = '';

	/**
	 * @var string
	 */
	private $ImageNew = '';

	/**
	 * Prefixes of this board
	 * @var array
	 */
	private $Prefixes = [];

	/**
	 * Are prefixes required for threads in this board?
	 * @var bool
	 */
	private $PrefixesRequired = false;

	/**
	 * Number of views in this board
	 * @var int
	 */
	private $Views = 0;

	/**
	 * Number of threads in this board
	 * @var int
	 */
	private $NumThreads = 0;

	/**
	 * Number of posts in this board
	 * @var int
	 */
	private $NumPosts = 0;

	/**
	 * @var bool
	 */
	private $MarkingAsDone = false;

	/**
	 * Is it closed and locked?
	 * @var bool
	 */
	private $Closed = false;

	/**
	 * Is this board visible at all?
	 * @var bool
	 */
	private $Visible = true;

	/**
	 * Is this a news board?
	 * @var bool
	 */
	private $News = false;

	/**
	 * ID of the last post in this board
	 * @var int
	 */
	private $LastPostId = 0;

	/**
	 * Object of the last post
	 * @var Post
	 */
	private $LastPost = null;

	/**
	 * Children of this board
	 * @var array
	 */
	private $Children = [];
	
	
	
	public function __construct(int $Type, $Input) {
		
		switch($Type) {
			
			case self::GIVEN_ID:
				$this->Id = $Input;
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

		$Query = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ID` = :ID');
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
		$this->ParentId = $Row->ParentID;
		$this->Type = $Row->Type;
		$this->Title = htmlspecialchars($Row->Title);
		$this->Desc = htmlspecialchars($Row->Description);
		$this->Link = $this->Type == (self::TYPE_LINK ? htmlspecialchars($Row->Link) : URI::Make([['page', 'Board'], ['BoardID', $this->Id, $this->Title]]));
		$this->Views = $Row->Views;
		$this->NumThreads = $Row->Threads;
		$this->NumPosts = $Row->Posts;
		$this->Position = $Row->Position;
		$this->Image = $Row->Image;
		$this->ImageNew = $Row->ImageNew;
		$this->PrefixesRequired = ($Row->PrefixesRequired == 1);
		$this->MarkingAsDone = ($Row->MarkingAsDone == 1);
		$this->Closed = ($Row->Closed == 1);
		$this->Visible = ($Row->Invisible == 0);
		$this->News = ($Row->News == 1);
		$this->Prefixes = explode(';', $Row->Prefixes);
		$this->LastPostId = $Row->LastPostId;

	}

	/**
	 * Save all variables to the DB
	 */
	public function Save() {

		// Just saving everything, don't panic
		$Query = SBB::DB()->prepare('UPDATE `board`
			SET `ParentID` = :ParentID,
				`Type` = :Type,
				`Title` = \':Title\',
				`Description` = \':Description\',
				`Link` = \':Link\',
				`Position` = :Position,
				`Image` = \':Image\',
				`ImageNew` = \':ImageNew\',
				`Prefixes` = \':Prefixes\',
				`PrefixesRequired` = :PrefixesRequired,
				`Views` = :Views,
				`Threads` = :Threads,
				`Posts` = :Posts,
				`MarkingAsDone` = :MarkingAsDone,
				`Closed` = :Closed,
				`Invisible` = :Invisible,
				`News` = :News
			WHERE `ID` = :ID');

		return $Query->execute([
			':ParentID' => $this->ParentId,
			':Type' => $this->Type,
			':Title' => $this->Title,
			':Description' => $this->Desc,
			':Link' => $this->Link,
			':Position' => $this->Position,
			':Image' => $this->Image,
			':ImageNew' => $this->ImageNew,
			':Prefixes' => implode(';', $this->Prefixes),
			':PrefixesRequired' => ($this->PrefixesRequired ? '1' : '0'),
			':Views' => $this->Views,
			':Threads' => $this->NumThreads,
			':Posts' => $this->NumPosts,
			':MarkingAsDone' => ($this->MarkingAsDone ? '1' : '0'),
			':Closed' => ($this->Closed ? '1' : '0'),
			':Invisible' => (!$this->Visible ? '1' : '0'),
			':News' => ($this->News ? '1' : '0'),
			':ID' => $this->Id
		]);

	}

	
	/*
	 * ###### GETTERS ######
	 */


	/**
	 * Get its children!
	 * @return array
	 */
	public function GetChildren() {

		$Query = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ParentID` = :BoardID ORDER BY `Position`');
		$Query->execute([':BoardID' => $this->Id]);
		$Data = $Query->fetchAll(PDO::FETCH_OBJ);

		$Children = [];

		foreach($Data as $Entry) {

			$Children[] = new Board(self::GIVEN_ROW, $Entry);

		}

		return $Children;

	}

	/**
	 * @return boolean
	 */
	public function GetClosed() {
		return $this->Closed;
	}

	/**
	 * @return string
	 */
	public function GetDesc() {
		return $this->Desc;
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
	public function GetImage() {
		return $this->Image;
	}

	/**
	 * @return string
	 */
	public function GetImageNew() {
		return $this->ImageNew;
	}

	/**
	 * @return \Post
	 */
	public function GetLastPost() {

		if(is_null($this->LastPost))
			$this->LastPost = new Post(Post::GIVEN_ID, $this->LastPostId);

		return $this->LastPost;
	}

	/**
	 * @return string
	 */
	public function GetLink() {
		return $this->Link;
	}

	/**
	 * @return boolean
	 */
	public function GetMarkingAsDone() {
		return $this->MarkingAsDone;
	}

	/**
	 * @return boolean
	 */
	public function GetNews() {
		return $this->News;
	}

	/**
	 * @return int
	 */
	public function GetNumPosts() {
		return $this->NumPosts;
	}

	/**
	 * @return int
	 */
	public function GetNumThreads() {
		return $this->NumThreads;
	}

	/**
	 * @return \Board
	 */
	public function GetParentBoard() {

		if(is_null($this->ParentBoard))
			$this->ParentBoard = new Board(self::GIVEN_ID, $this->ParentId);

		return $this->ParentBoard;
	}

	/**
	 * @return int
	 */
	public function GetPosition() {
		return $this->Position;
	}

	/**
	 * @return array
	 */
	public function GetPrefixes() {
		return $this->Prefixes;
	}

	/**
	 * @return boolean
	 */
	public function GetPrefixesRequired() {
		return $this->PrefixesRequired;
	}

	/**
	 * @return string
	 */
	public function GetTitle() {
		return $this->Title;
	}

	/**
	 * @return int
	 */
	public function GetType() {
		return $this->Type;
	}

	/**
	 * @return int
	 */
	public function GetViews() {
		return $this->Views;
	}

	/**
	 * @return boolean
	 */
	public function GetVisible() {
		return $this->Visible;
	}
	
	
	/*
	 * ###### SETTERS ######
	 */

	/**
	 * @param boolean $Closed
	 */
	public function SetClosed($Closed) {
		$this->Closed = $Closed;
	}

	/**
	 * @param string $Desc
	 */
	public function SetDesc($Desc) {
		$this->Desc = htmlspecialchars($Desc);
	}

	/**
	 * @param string $Image
	 */
	public function SetImage($Image) {
		$this->Image = $Image;
	}

	/**
	 * @param string $ImageNew
	 */
	public function SetImageNew($ImageNew) {
		$this->ImageNew = $ImageNew;
	}

	/**
	 * @param int $LastPostId
	 */
	public function SetLastPostId($LastPostId) {
		$this->LastPostId = $LastPostId;
		$this->LastPost = null;
	}

	/**
	 * @param string $Link
	 */
	public function SetLink($Link) {
		if($this->Type == self::TYPE_LINK)
			$this->Link = $Link;
	}

	/**
	 * @param boolean $MarkingAsDone
	 */
	public function SetMarkingAsDone($MarkingAsDone) {
		$this->MarkingAsDone = $MarkingAsDone;
	}

	/**
	 * @param boolean $News
	 */
	public function SetNews($News) {
		$this->News = $News;
	}

	/**
	 * @param int $NumPosts
	 */
	public function SetNumPosts($NumPosts) {
		$this->NumPosts = $NumPosts;
	}

	/**
	 * @param int $NumThreads
	 */
	public function SetNumThreads($NumThreads) {
		$this->NumThreads = $NumThreads;
	}

	/**
	 * @param int $ParentId
	 */
	public function SetParentId($ParentId) {
		$this->ParentId = $ParentId;
		$this->ParentBoard = null;
	}

	/**
	 * @param int $Position
	 */
	public function SetPosition($Position) {
		$this->Position = $Position;
	}

	/**
	 * @param array $Prefixes
	 */
	public function SetPrefixes($Prefixes) {
		$this->Prefixes = $Prefixes;
	}

	/**
	 * @param boolean $PrefixesRequired
	 */
	public function SetPrefixesRequired($PrefixesRequired) {
		$this->PrefixesRequired = $PrefixesRequired;
	}

	/**
	 * @param string $Title
	 */
	public function SetTitle($Title) {
		$this->Title = htmlspecialchars($Title);
	}

	/**
	 * @param int $Type
	 */
	public function SetType($Type) {
		$this->Type = $Type;
	}

	/**
	 * @param int $Views
	 */
	public function SetViews($Views) {
		$this->Views = $Views;
	}

	/**
	 * @param boolean $Visible
	 */
	public function SetVisible($Visible) {
		$this->Visible = $Visible;
	}

}