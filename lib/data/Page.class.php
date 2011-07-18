<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class Page {
	private static $Page;
	
	public static function Initial() {
		if(isset($_GET['page']))
			self::$Page = $_GET['page'];
		else
			self::$Page = null;
		
		self::Check();
		//self::$TPL->Assign(array('BreadCrumbs' => crumb::Parse(), 'Menu' => menu::Parse()));
	}
	
	public static function Check() {
		// Exclude Paths
		if(strpos(self::$Page, '/') !== false)
			self::Open('Error');
		else {
			if(!self::$Page)
				self::Open('Home');
			else if(file_exists(DIR_PAGE.self::$Page.'Page.class.php'))
				self::Open(self::$Page);
			else
				self::Open('Error');
		}
	}
	
	private static function Open($Page) {
		if(file_exists($File = DIR_PAGE.$Page.'Page.class.php')) {
			include($File);
			//$Page .= 'Page';
			//$Page::Load(); // PHP 5.3
			eval($Page.'Page::Load();');
		}
	}
}
?>