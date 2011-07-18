<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
 */

class Page {
	private static $TPL;
	private static $Page;
	
	public static $Info = array();
	
	public static function Initial(/*&$TemplateObject*/) {
		if(isset($_GET['page']))
			self::$Page = $_GET['page'];
		else
			self::$Page = null;
		
		//self::$TPL = $TemplateObject;
		self::Open();
		//self::$TPL->Assign(array('BreadCrumbs' => crumb::Parse(), 'Menu' => menu::Parse()));
	}
	
	public static function Open() {
		// Pfade in Page-Angabe ausschließen
		if(strpos(self::$Page, '/') !== false)
			include(DIR_PAGE.'Error.php');
		else {
			// Ruft die entsprechende Datei auf, die für die Verwaltung der Seiten zuständig ist.
			if(self::$Page == '' || self::$Page == null || !self::$Page)
				include(DIR_PAGE.'Index.php');
			else if(file_exists(DIR_PAGE.self::$Page.'.php'))
				include(DIR_PAGE.self::$Page.'.php');
			else // Wenn nichts gefunden wurde
				include(DIR_PAGE.'Error.php');
		}
	}
}
?>