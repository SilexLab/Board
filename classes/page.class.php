<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

class page {
	
	private static $TPL;
	private static $Page;
	
	public static function Initial(&$TemplateObject) {
		if(isset($_GET['page']))
			self::$Page = $_GET['page'];
		else
			self::$Page = null;
		
		self::$TPL = $TemplateObject;
                $Menu = new menu;
		self::Open();
		self::$TPL->Assign(array('BreadCrumbs' => crumb::Parse(), 'Menu' => $Menu->Parse()));
	}
	
	public static function Open() {
		// Pfade in Page-Angabe ausschließen
		if(strpos(self::$Page, '/') !== false)
			include(PATH_PAGE.'Error.php');
		else {
			// Ruft die entsprechende Datei auf, die für die Verwaltung der Seiten zuständig ist.
			if(self::$Page == '' || self::$Page == null || !self::$Page)
				include(PATH_PAGE.'Index.php');
			else if(file_exists(PATH_PAGE.self::$Page.'.php'))
				include(PATH_PAGE.self::$Page.'.php');
			else // Wenn nichts gefunden wurde
				include(PATH_PAGE.'Error.php');
		}
	}
}
?>