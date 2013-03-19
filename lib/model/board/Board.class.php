<?php
/**
 * @author      Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
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
	protected $Id = 0;

	/**
	 * ID of the parent board. 0 for none
	 * @var int
	 */
	protected $ParentId = 0;

	/**
	 * Is this a category, board or link? See Board::TYPE_* constants
	 * @var int
	 */
	protected $Type = 0;

	/**
	 * Object of the parent board. null for none
	 * @var Board
	 */
	protected $ParentBoard = null;

	/**
	 * Title of this board
	 * @var string
	 */
	protected $Title = '';

	/**
	 * Description of this board
	 * @var string
	 */
	protected $Desc = '';

	/**
	 * If this is of TYPE_LINK, the link
	 * @var string
	 */
	protected $Link = '';

	/**
	 * Positioning order
	 * @var int
	 */
	protected $Position = 0;

	/**
	 * Image of this board
	 * @var string
	 */
	protected $Image = '';

	/**
	 * @var string
	 */
	protected $ImageNew = '';

	/**
	 * Prefixes of this board
	 * @var array
	 */
	protected $Prefixes = [];

	/**
	 * Are prefixes required for threads in this board?
	 * @var bool
	 */
	protected $PrefixesRequired = false;

	/**
	 * Number of views in this board
	 * @var int
	 */
	protected $ViewCount = 0;

	/**
	 * Number of threads in this board
	 * @var int
	 */
	protected $ThreadCount = 0;

	/**
	 * Number of posts in this board
	 * @var int
	 */
	protected $PostCount = 0;

	/**
	 * @var bool
	 */
	protected $MarkingAsDone = false;

	/**
	 * Is it closed and locked?
	 * @var bool
	 */
	protected $Closed = false;

	/**
	 * Is this board visible at all?
	 * @var bool
	 */
	protected $Visible = true;

	/**
	 * Is this a news board?
	 * @var bool
	 */
	protected $News = false;

	/**
	 * ID of the last post in this board
	 * @var int
	 */
	protected $LastPostId = 0;

	/**
	 * Object of the last post
	 * @var Post
	 */
	protected $LastPost = null;

	/**
	 * Children of this board. Buffer for GetChildren()
	 * @var array
	 */
	protected $Children = [];

	/**
	 * Buffer for GetThreads()
	 * @var array
	 */
	protected $Threads = [];


	/**
	 * Create a new board object
	 * @param int $Type
	 * @param mixed $Input Row or ID of the post
	 * @throws NotFoundException
	 */
	public function __construct($Type, $Input) {
		
		switch($Type) {
			
			case self::GIVEN_ID:
				$this->Id = $Input;
				if(!$this->Fetch())
					throw new NotFoundException();
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

		$Query = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ID` = :ID');
		$Query->execute([':ID' => $this->Id]);

		$Result = $Query->fetch(PDO::FETCH_OBJ);

		if(!$Result)
			return false;

		$this->FetchRow($Result);

		return true;

	}

	/**
	 * Fetch by given row from DB
	 * @param stdClass $Row
	 */
	protected function FetchRow(stdClass $Row) {
		
		if($this->Id == 0)
			$this->Id = $Row->ID;

		// Split it up and save
		$this->ParentId = $Row->ParentID;
		$this->Type = $Row->Type;
		$this->Title = htmlspecialchars($Row->Title);
		$this->Desc = htmlspecialchars($Row->Description);
		$this->Link = ($this->Type == self::TYPE_LINK ? htmlspecialchars($Row->Link) : URI::Make([['page', 'Board'], ['BoardID', $this->Id, htmlspecialchars_decode($this->Title)]]));
		$this->ViewCount = $Row->Views;
		$this->ThreadCount = $Row->Threads;
		$this->PostCount = $Row->Posts;
		$this->Position = $Row->Position;
		$this->Image = $Row->Image;
		$this->ImageNew = $Row->ImageNew;
		$this->PrefixesRequired = ($Row->PrefixesRequired == 1);
		$this->MarkingAsDone = ($Row->MarkingAsDone == 1);
		$this->Closed = ($Row->Closed == 1);
		$this->Visible = ($Row->Invisible == 0);
		$this->News = ($Row->News == 1);
		$this->Prefixes = explode(';', $Row->Prefixes);
		$this->LastPostId = $Row->LastPostId; // TODO: Does this even exist?

	}

	/**
	 * Save all variables to the DB
	 */
	public function Save() {

		// Just saving everything, don't panic
		$Query = SBB::DB()->prepare('UPDATE `board`
			SET `ParentID` = :ParentID,
				`Type` = :Type,
				`Title` = :Title,
				`Description` = :Description,
				`Link` = :Link,
				`Position` = :Position,
				`Image` = :Image,
				`ImageNew` = :ImageNew,
				`Prefixes` = :Prefixes,
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
			':Views' => $this->ViewCount,
			':Threads' => $this->ThreadCount,
			':Posts' => $this->PostCount,
			':MarkingAsDone' => ($this->MarkingAsDone ? '1' : '0'),
			':Closed' => ($this->Closed ? '1' : '0'),
			':Invisible' => (!$this->Visible ? '1' : '0'),
			':News' => ($this->News ? '1' : '0'),
			':ID' => $this->Id
		]);

	}

	
	/* Getters */


	/**
	 * Get its children!
	 * @return array
	 */
	public function GetChildren() {

		// Is this buffered already?
		if(!empty($this->Children))
			return $this->Children;

		$Query = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ParentID` = :BoardID ORDER BY `Position`');
		$Query->execute([':BoardID' => $this->Id]);
		$Data = $Query->fetchAll(PDO::FETCH_OBJ);

		$Children = [];

		foreach($Data as $Entry) {

			$Children[] = new Board(self::GIVEN_ROW, $Entry);

		}

		// Save into buffer
		$this->Children = $Children;

		return $Children;

	}

	/**
	 * Get the threads of this board
	 * @param int|null $Start Number to start with
	 * @param int|null $End   Number to end with
	 * @return array
	 */
	public function GetThreads($Start = null, $End = null) {

		// Is this buffered already?
		if(!empty($this->Threads))
			return $this->Threads;

		/* Query */

		$Query = 'SELECT * FROM `thread` WHERE `BoardID` = :ID ORDER BY `Sticky` = 1 DESC, `LastPostTime` DESC';
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
		$Threads = [];

		/* Fetch them! */
		foreach($Data as $Row) {

			$Threads[] = new Thread(Thread::GIVEN_ROW, $Row);

		}

		// Save into buffer
		$this->Threads = $Threads;

		return $Threads;

	}

	/**
	 * Get breadcrumbs for this board
	 * @return array
	 */
	public function GetBreadcrumbs() {

		return BoardUtil::GetBreadcrumbs($this);

	}

    /**
     * Grab the link for creating a new thread
     * @return string
     */
    public function GetNewThreadLink() {

        return URI::Make([['page', 'Compose'], ['Type', ComposePage::TYPE_THREAD, Language::Get('compose.compose_thread')], ['Target', $this->Id, $this->Topic]]);

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

		if(is_null($this->LastPost)) {

			try {
				$this->LastPost = new Post(Post::GIVEN_ID, $this->LastPostId);
			}
			catch(NotFoundException $e) {

				$this->LastPost = false;
				return false;

			}

		}

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
	public function GetPostCount() {
		return $this->PostCount;
	}

	/**
	 * @return int
	 */
	public function GetThreadCount() {
		return $this->ThreadCount;
	}

	/**
	 * @return \Board
	 */
	public function GetParentBoard() {

		if(is_null($this->ParentBoard) && $this->ParentId != 0)
			$this->ParentBoard = new Board(self::GIVEN_ID, $this->ParentId);

		if(is_null($this->ParentBoard) || $this->ParentBoard === false)
			return false;

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
	public function GetViewCount() {
		return $this->ViewCount;
	}

	/**
	 * @return boolean
	 */
	public function GetVisible() {
		return $this->Visible;
	}

	/**
	 * Get an array suitable for assigning for the template engine of this board
	 * @return array
	 */
	public function GetTemplateArray() {

		$array = [
			'id' => $this->Id,
			'type' => $this->Type,
			'title' => $this->Title,
			'desc' => $this->Desc,
			'link' => $this->Link,
			'image' => $this->Image,
			'viewCount' => $this->ViewCount,
			'threadCount' => $this->ThreadCount,
			'postCount' => $this->PostCount,
			'closed' => $this->Closed,
			'visible' => $this->Visible,
			'news' => $this->News,
			'parentBoard' => ($this->GetParentBoard() !== false ? $this->GetParentBoard()->GetTemplateArray() : null),
			'lastPost' => ($this->GetLastPost() !== false ? $this->GetLastPost()->GetTemplateArray() : null),
			'object' => $this
		];

		return $array;

	}
	
	/* Setters */

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
	public function SetPostCount($NumPosts) {
		$this->PostCount = $NumPosts;
	}

	/**
	 * @param int $NumThreads
	 */
	public function SetThreadCount($NumThreads) {
		$this->ThreadCount = $NumThreads;
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
	public function SetViewCount($Views) {
		$this->ViewCount = $Views;
	}

	/**
	 * @param boolean $Visible
	 */
	public function SetVisible($Visible) {
		$this->Visible = $Visible;
	}

}
