<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SBB {
	// Objects
	private static $Database = null, $Config = null, $Template = null, $Style = null, $Menu = null, $Page = null;
	
	/**
	 * Initial
	 * @return void
	 */
	public static final function Initial() {
		// Initialize classes and objects
		self::$Style = Style::GetInstance();
		Language::Initialize();
		self::$Menu = Menu::GetInstance();
		
		// Template assignment
		self::Template()->Set(array('Style' => self::Style()->Info()));
		// TODO: Move this to a method somewhere else (maybe)
		self::Template()->Set(array('Dir' => array(
			'Style' => DIR_STYLE,
			'JS' => DIR_JS
		)));
		self::Template()->Set(Language::Get(), true);
		
		// Display the template
		self::Template()->Display('case.tpl');
	}
	
	/**
	 * Returns the config value
	 * @param  string $Node
	 * @return string
	 */
	public static final function Config($Node) {
		if(!self::$Config)
			self::$Config = new Config();
		return self::$Config->Get($Node);
	}
	
	/**
	 * Returns the database object
	 * @return Database
	 */
	public static final function DB() {
		if(!self::$Database)
			self::$Database = Database::GetDatabase();
		return self::$Database;
	}
	
	/**
	 * Returns the Template wrapper object
	 * @return Template
	 */
	public static final function Template() {
		if(!self::$Template)
			self::$Template = new Template(DIR_ROOT.DIR_TPL, DIR_ROOT.self::Style()->Info('TPL'));
		return self::$Template;
	}

	/**
	 * Returns the current page object
	 * @return Page
	 */
	public static final function Page() {
		if(!self::$Page)
			self::$Page = Page::GetPage();
		return self::$Page;
	}

	/**
	 * Returns the style object
	 * @return Style
	 */
	public static final function Style() {
		/*if(!self::$Style)
			self::$Style = Style::GetInstance();*/
		return self::$Style;
	}
	
	/**
	 * Handles uncatched exceptions and calls the Show() method in the given cases
	 * @param Exception	$e
	 */
	public static final function ExceptionHandler(Exception $e) {
		if($e instanceof PrintableException) {
			$e->Show();
			exit;
		}
		echo $e;
	}
}
?>