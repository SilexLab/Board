<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

require_once('Page.interface.php');
require_once('page/HomePage.class.php'); // <- REMOVE
require_once('page/BlubPage.class.php'); // <- REMOVE
class Page {
	const FILENAME  = '/^(\w+)Page\.class\.php$/';
	const CLASSNAME = '/^(\w+)Page$/';

	private $Pages = [];

	private $Instance;

	public function __construct($Page = '') {
		if(empty($Page))
			$Page = 'Home'; // <- GET
		
		$Page = $this->Validate($Page);
		$Class = $Page.'Page';
		$this->Instance = new $Class();
		$this->Pages[$Page] = &$this->Instance;

		// Check the "must have" instance of the new instance
		if(!($this->Instance instanceof IPage))
			throw new SystemException('"'.$Class.'" is not an instance of "IPage"');

		// "Display" the page
		$this->Instance->Display($this);
	}

	/**
	 * Get the link from a page
	 * If $Page isn't set, the Link of the current page will returned
	 * @param  string $Page optional
	 * @return string
	 */
	public function Link($Page = '') {
		if(empty($Page))
			return $this->Instance->Link();
		// $this->Pages[$Page] has an instance
		if(isset($this->Pages[$Page]))
			return $this->Pages[$Page]->Link();
		// Create a new instance
		if(array_key_exists($Page, $this->Pages) && is_null($this->Pages[$Page])) {
			$Class = $Page.'Page';
			$this->Pages[$Page] = new $Class();
			return $this->Pages[$Page]->Link();
		}
		return false;
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

	/**
	 * Get the name of the current page
	 * @return string
	 */
	public function Name() {
		return preg_replace(self::CLASSNAME, '$1', get_class($this->Instance));
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
		if(empty($Page))
			return 'Home';
		if(array_key_exists($Page, $this->Pages))
			return $Page;
		return 'Error';
	}

	private function GetAvailablePages() {
		foreach (scandir('page') as $f) { // <- DIR_PAGE
			if(preg_match(self::FILENAME, $f, $m)) {
				$this->Pages[$m[1]] = null;
			}
		}
	}
}