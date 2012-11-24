<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

require_once('IPage.interface.php');
class Page {
	const FILENAME  = '/^(\w+)Page\.class\.php$/';
	const CLASSNAME = '/^(\w+)Page$/';

	private $Pages = [];

	private $Instance;

	private $URI;

	public function __construct($Page = '') {
		if(defined('CLASS_PAGE'))
			return;
		define('CLASS_PAGE', true);
		
		$this->URI = new URI();
		if(empty($Page))
			$Page = $this->URI->Get('page');
		
		$Page = $this->Validate($Page);
		$Class = $Page.'Page';
		$this->Instance = new $Class($this);
		$this->Pages[$Page] = &$this->Instance;

		// Check the "must have" instance of the new instance
		if(!($this->Instance instanceof IPage))
			throw new SystemException('"'.$Class.'" is not an instance of "IPage"');

		// Home Breadcrumb
		Breadcrumb::Add(Language::Get('sbb.page.home'), $this->Link('Home'));
		// "Display" the page
		$this->Instance->Display($this);
	}

	/**
	 * Access to the URI instance
	 * @return URI
	 */
	public function URI() {
		return $this->URI;
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

	public function MenuEntry() {
		$Page = $this->Instance->Info('menu');
		return $Page ? $Page : $this->Name();
	}

	/**
	 * Get the instance of $Page
	 * @param  string $Page
	 * @return PageData
	 */
	public function Get($Page) {
		return isset($this->Pages[$Page]) ? $this->Pages[$Page] : false;
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
		foreach (scandir(DIR_PAGE) as $f) {
			if(preg_match(self::FILENAME, $f, $m)) {
				$this->Pages[$m[1]] = null;
			}
		}
	}
}
