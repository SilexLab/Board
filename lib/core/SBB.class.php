<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SBB {
	// Objects
	private static
		$Database = null,
		$Config   = null,
		$Template = null,
		$Style    = null,
		$Menu     = null,
		$Page     = null,
		$User     = null;
	
	/**
	 * Initial
	 * @return void
	 */
	public static final function Initial() {
		// Initialize classes and objects
		Language::Initialize(URI::Get('lang', 'null'));
		self::$Style = Style::GetInstance();
		self::$Template = new Template(DIR_ROOT.DIR_TPL, self::$Style->Info('tpl'));
		self::$User = new User();
		Listener::Check();
		SessionGarbageCollector::Collect();
		self::$Menu = Menu::GetInstance();
		
		// Pre-output
		self::AssignDefault();

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

	/**
	 * Assign default stuff to template
	 */
	private static function AssignDefault() {
		self::Template()->Assign([
			'style' => ['dir' => DIR_STYLE.rawurlencode(self::Style()->Info('dir')).'/',
				'files' => self::Style()->Info('files'),
				'name' => self::Style()->Info('name')],
			'page_title' => self::Config('config.page.title'),
			'logo' => DIR_STYLE.str_replace(' ', '%20', self::Style()->Info('dir')).'/images/logo.png',
			'dir' => array(
				'style' => DIR_STYLE,
				'js' => DIR_JS
			),
			'time' => array(
				'date' => date('d.m.Y'), // TODO: Get date format from user / config
				'time' => date('H:i'),
				'y_percent' => round(100 * Time::YearProcess(), 2),
				'd_percent' => round(100 * Time::DayProcess(), 2)
			),
			'version' => array(
				'full' => SBB_VERSION.'-'.date('Ymd', CommitInfo::Get()),
				'sha' => CommitInfo::Get('SHA')
			)
		]);
		Breadcrumb::Assign();
		Page::Assign();
		Notification::Assign();
	}
}
?>