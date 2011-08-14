<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

abstract class Page extends SBB {
	
	protected static function GetPage($Page = '') {
		if($Page == '')
			$Page = isset($_Get['page']) ? $_Get['page'] : NULL;
		return self::Open(self::Validate($Page).'Page');
	}
	
	private static function Validate($Page) {
		if(strpos($Page, '/') !== false || strpos($Page, '\\') !== false)
			return 'Error';
		if(!$Page)
			return 'Home';
		if(file_exists(DIR_PAGE.self::$Page.'Page.class.php'))
			return $Page;
		return 'Error';
	}
	
	private static function Open($Page) {
		return new $Page;
	}
	
	
	/* Abstract functions for the child classes */
	
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