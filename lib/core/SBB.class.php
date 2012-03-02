<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SBB {
	// Objects
	private static $Database = null,
		$Config = null,
		$Template = null,
		$Style = null,
		$Menu = null,
		$Page = null,
		$User = null;
	
	/**
	 * Initial
	 * @return void
	 */
	public static final function Initial() {
		// Initialize classes and objects
		Language::Initialize(isset($_GET['lang']) ? $_GET['lang'] : null);
		self::$Style = Style::GetInstance();
		self::$Template = new Template(DIR_ROOT.DIR_TPL, DIR_ROOT.self::Style()->Info('TPL'), SBB::Config('config.system.cache.dir'));
		self::$User = new User();
		PostListener::Check();
		self::$Menu = Menu::GetInstance();
		
		// Template assignment
		self::Template()->Set(array('Style' => self::Style()->Info()));
		self::Template()->Set(array('Dir' => array( // TODO: Move this to a method somewhere else (maybe)
			'Style' => DIR_STYLE,
			'JS' => DIR_JS
		)));
		self::Template()->Set(array('Time' => array(
			'Date' => date('d.m.Y'), // TODO: Get date format from user / config
			'Time' => date('H:i'),
			'YPercent' => round(100 * Time::YearProcess(), 0),
			'DPercent' => round(100 * Time::DayProcess(), 0)
		)));
		self::Template()->Set(Language::Get(), true);
		Breadcrumb::Assign();
		Page::Assign();
		
		// Display the template
		self::Template()->Display('case.tpl');
	}

	/**
	 * Returns the user object
	 * @return User
	 */
	public static final function User() {
		return self::$User;
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