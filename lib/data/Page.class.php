<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

require_once('Page.interface.php');
abstract class Page {
	/**
	 * Contains all founded pages
	 * @var array $Pages
	 */
	protected static $Links = array();

	/**
	 * Validates $Page and returns a new instance of Page
	 * @param  string $Page
	 * @return Page
	 */
	public static function GetPage($Page = '') {
		if(!defined('CLASS_PAGE')) {
			define('CLASS_PAGE', 1);

			if($Page == '')
				$Page = isset($_GET['page']) ? $_GET['page'] : null;
			Breadcrumb::Add(Language::Get('com.sbb.page.home'), './');
			return self::Open(self::Validate($Page));
		}
	}

	/**
	 * Returns the link of the given page node
	 * @param  string $Node
	 * @return string
	 */
	public static function GetLink($Node) {
		$eNode = explode('.', $Node);
		// If it's not a Node, return that we've got
		if($eNode[0] != 'page')
			return $Node;
		
		if(empty(self::$Links)) {
			// List all available links
			foreach(scandir(DIR_PAGE) as $File) {
				if(is_dir($File))
					continue;
				$eFile = explode('.', $File);
				$Class = $eFile[0];
				$Link = $Class::Link();
				if($Link)
					self::$Links[$Class::Node()] = $Link;
			}
		}
		// Search for the right page
		return isset(self::$Links[$Node]) ? self::$Links[$Node] : $Node;
	}

	/**
	 * Check if the given page exists
	 * Returns a validated page class string
	 * @param  string $Page
	 * @return string
	 */
	private static function Validate($Page) {
		if(strpos($Page, '/') !== false || strpos($Page, '\\') !== false)
			return 'ErrorPage';
		if(!$Page)
			return 'HomePage';
		if(file_exists(DIR_PAGE.$Page.'Page.class.php'))
			return $Page.'Page';
		return 'ErrorPage';
	}

	/**
	 * Create a new instance of $Page
	 * @param  string $Page
	 * @return Page
	 */
	private static function Open($Page) {
		$Instance = new $Page;
		// Check the instances of the new object
		if(!($Instance instanceof PageData))
			throw new SystemException('"'.$Page.'" is not an instance of "PageData"');
		if(!($Instance instanceof Page))
			throw new SystemException('"'.$Page.'" is not an instance of "Page"');
		return $Instance;
	}

	// Abstract method

	/**
	 * Do Something with the Page
	 */
	abstract public function __construct();
	
	/**
	 * Getting infos about the page
	 * If no parameter is given, all available Infos will returned
	 * Return false if the given Info don't exists
	 */
	abstract public function GetInfo($Info);
}
?>