<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

require_once('Page.interface.php');
class Page {
	/**
	 * Current page instance
	 */
	protected $Instance;

	/**
	 * All pages
	 */
	protected $Pages = [];
	protected $Links = [];

	public function __construct($Page = '') {
		if(empty($Page))
			$Page = URI::Get('page');

		// Current Page
		$Page = $this->Validate($Page);
		$this->Instance = new $Page;

		// Check the "must have" instance of the new instance
		if(!($this->Instance instanceof PageData))
			throw new SystemException('"'.$Page.'" is not an instance of "PageData"');

		// Display the page
		Breadcrumb::Add(Language::Get('sbb.page.home'), $this->Link('Home'));
		$this->Instance->Display();
	}

	/**
	 * Get the link from a page
	 * If $Page isn't set, the Link of the current page will returned
	 * @param  string $Page optional
	 * @return string
	 */
	public function Link($Page = '') {
		if(preg_match('/p:(\w+)/', $Page, $m))
			$Page = $m[1];
		if(empty($Page))
			return $this->Instance->Link();
		if(isset($this->Links[$Page]))
			return $this->Links[$Page];
		if(isset($this->Pages[$Page])) {
			$Class = $this->Pages[$Page];
			$this->Links[$Page] = (new $Class)->Link();
			return $this->Links[$Page];
		}
		return $Page;
	}

	/**
	 * Get the template file wich belongs to the page
	 * @return string
	 */
	public function Template() {
		return $this->Instance->Template();
	}

	/**
	 * Get the title of the current page
	 * @return string
	 */
	public function Title() {
		return $this->Instance->Title();
	}

	public function Name() {
		return preg_replace('/^(\w+)Page$/', '$1', get_class($this->Instance));
	}

	/**
	 * Get additional information if available
	 * @param  string $Info
	 * @return mixed
	 */
	public function Info($Info) {
		return $this->Instance->Info($Info);
	}

	/**
	 * Check if $Page exists
	 * @param  string $Page
	 * @return string
	 */
	private function Validate($Page) {
		$this->GetAvailablePages();
		if(strfind($Page, '/') || strfind($Page, '\\'))
			return $this->Pages['Error'];

		if(!$Page)
			return $this->Pages['Home'];
		if(isset($this->Pages[$Page]))
			return $this->Pages[$Page];
		return $this->Pages['Error'];
	}

	/**
	 * Put all available pages into $this->Pages
	 */
	private function GetAvailablePages() {
		if(empty($this->Pages)) {
			foreach(scandir(DIR_PAGE) as $p) {
				if(preg_match('/^((\w+)Page)\.class\.php$/', $p, $m)) {
					$this->Pages[$m[2]] = $m[1];
				}
			}
		}
	}
}







// abstract class Page {
// 	/**
// 	 * Contains all founded pages
// 	 * @var array $Pages
// 	 */
// 	protected static $Links = array();
// 	private static $Instance;

// 	/**
// 	 * Validates $Page and returns a new instance of Page
// 	 * @param  string $Page
// 	 * @return Page
// 	 */
// 	public static function GetPage($Page = '') {
// 		if(!defined('CLASS_PAGE')) {
// 			define('CLASS_PAGE', 1);

// 			if($Page == '')
// 				$Page = URI::Get('page');
// 			Breadcrumb::Add(Language::Get('sbb.page.home'), HomePage::Link());
// 			return self::Open(self::Validate($Page));
// 		}
// 	}

// 	/**
// 	 * Returns the link of the given page node
// 	 * @param  string $Node
// 	 * @return string
// 	 */
// 	public static function GetLink($Node) {
// 		$eNode = explode('.', $Node);
// 		// If it's not a Node, return that we've got
// 		if($eNode[0] != 'page')
// 			return $Node;
		
// 		if(empty(self::$Links)) {
// 			// List all available links
// 			foreach(scandir(DIR_PAGE) as $File) {
// 				if(is_dir($File))
// 					continue;
// 				$eFile = explode('.', $File);
// 				$Class = $eFile[0];
// 				$Link = $Class::Link();
// 				if($Link)
// 					self::$Links[$Class::Node()] = $Link;
// 			}
// 		}
// 		// Search for the right page
// 		return isset(self::$Links[$Node]) ? self::$Links[$Node] : $Node;
// 	}

// 	/**
// 	 * Assign to Template
// 	 */
// 	public static function Assign() {
// 		$Info = self::$Instance->GetWholeInfo();
// 		$Class = get_class(self::$Instance);
// 		$Info['link'] = $Class::$Link;
// 		$Info['page'] = URI::Get('page');
// 		unset($Info['node']);
// 		SBB::Template()->Assign(['page' => $Info]);
// 	}

// 	/**
// 	 * Check if the given page exists
// 	 * Returns a validated page class string
// 	 * @param  string $Page
// 	 * @return string
// 	 */
// 	private static function Validate($Page) {
// 		if(strpos($Page, '/') !== false || strpos($Page, '\\') !== false)
// 			return 'ErrorPage';
// 		if(!$Page)
// 			return 'HomePage';
// 		if(file_exists(DIR_PAGE.$Page.'Page.class.php'))
// 			return $Page.'Page';
// 		return 'ErrorPage';
// 	}

// 	/**
// 	 * Create a new instance of $Page
// 	 * @param  string $Page
// 	 * @return Page
// 	 */
// 	private static function Open($Page) {
// 		self::$Instance = new $Page;
// 		// Check the instances of the new object
// 		if(!(self::$Instance instanceof PageData))
// 			throw new SystemException('"'.$Page.'" is not an instance of "PageData"');
// 		if(!(self::$Instance instanceof Page))
// 			throw new SystemException('"'.$Page.'" is not an instance of "Page"');
// 		return self::$Instance;
// 	}

// 	// Abstract method

// 	/**
// 	 * Do Something with the Page
// 	 */
// 	abstract public function __construct();
	
// 	/**
// 	 * Getting infos about the page
// 	 * If no parameter is given, all available Infos will returned
// 	 * Return false if the given Info don't exists
// 	 */
// 	abstract public function GetInfo($Info);

// 	/**
// 	 * Get the whole info
// 	 */
// 	abstract protected function GetWholeInfo();
// }
?>