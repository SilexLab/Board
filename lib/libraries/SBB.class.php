<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SBB {
	// Objects
	private static
		$Database = null,
		$Config   = null,
		$Template = null,
		$Theme    = null,
		$Nav      = null,
		$Page     = null,
		$User     = null;

	/**
	 * Initial
	 * @return void
	 */
	public static final function Initial() {
		/* Initialize classes and objects */
		// Data
		Language::Initialize(isset($_GET['l']) ? $_GET['l'] : null);
		self::$Template = new Template(DIR_LIB.DIR_TPL);
		self::$User = Session::GetUser();
		Listener::Check();
		self::$Theme = new Theme();
		new SessionGarbageCollector();
		
		// Frontend
		self::$Nav = new Nav();
		Mail::Init();

		// Pre-output
		self::AssignDefault();
		self::$Nav->Finish();

		// Display the template
		self::Template()->Display('index.tpl');
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
	 * @return PDO
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
			self::$Page = new Page();
		return self::$Page;
	}

	/**
	 * Returns the style object
	 * @return Theme
	 */
	public static final function Theme() {
		return self::$Theme;
	}

	/**
	 * Handles uncatched exceptions and calls the Show() method in the given cases
	 * @param Exception	$e
	 */
	public static final function ExceptionHandler(Exception $e) {
		if($e instanceof IPrintableException) {
			$e->Show();
			exit;
		}
		echo $e;
	}

	/**
	 * I can handle errors
	 * @param  int    $errno
	 * @param  string $errstr
	 * @param  string $errfile    optional
	 * @param  int    $errline    optional
	 * @param  array  $errcontext optional
	 * @return bool
	 */
	public static final function ErrorHandler($errno, $errstr, $errfile = '', $errline = 0, array $errcontext = []) {
		// scalar typehint solution
		// some awesome code here, soon

		// errorhandler

		// I can't handle this shit
		return false;
	}

	/**
	 * Assign default template stuff
	 */
	private static function AssignDefault() {
		self::$Template->Assign([
			'theme' => [ // TODO: Move to Theme
				'files' => [
					'css' => self::Theme()->Files()['css'],
					'js' => array_merge(self::GetGlobalJsFiles(), self::Theme()->Files()['js'])
				],
				'dir' => self::Theme()->Info('url'),
				'name' => self::Theme()->Info('name'),
				'logo' => self::Theme()->Info('logo')
			],
			// Current page
			'page' => [ // TODO: Move to Page
				'title' => self::Page()->Title(),
				'link' => self::Page()->Link(),
				'name' => self::Page()->Name(),
				'template' => self::Page()->Template()
			],
			'sbb' => [
				'version' => SBB_VERSION.'-'.date('Ymd', CommitInfo::Get()),
				'sha' => CommitInfo::Get('SHA')
			],
			'title' => self::Config('page.title'),
			'base_url' => CFG_BASE_URL,
			'debug' => (bool)CFG_DEBUG
		]);

		/* Put the stored stuff into the template */
		Breadcrumb::Assign();
		Notification::Assign();


		return;
		// OLD:
		/*self::Template()->Assign([
			'style' => ['dir' => CFG_BASE_URL.DIR_THEME.rawurlencode(self::Theme()->Info('dir')).'/',
				'css' => self::Theme()->Info('files'),
				'name' => self::Theme()->Info('name')],
			'page_title' => self::Config('page.title'),
			'logo' => self::Theme()->Info('url').'/images/logo.png',
			'dir' => [
				'style' => DIR_THEME,
				'js' => DIR_JS
			],
			'time' => [
				'date' => date('d.m.Y'),
				'time' => date('H:i'),
				'y_percent' => round(100 * TimeUtil::YearProcess(), 2),
				'd_percent' => round(100 * TimeUtil::DayProcess(), 2),
				'progress' => sprintf(Language::Get('time.progress'), 100 * TimeUtil::YearProcess()),
				'day_progress' => sprintf(Language::Get('time.dayprogress'), 100 * TimeUtil::DayProcess())
			]
		]);*/
	}

	// TODO: Move me
	private static function GetGlobalJsFiles() {
		$Order = ['jquery.js', 'jquery.min.js'];
		$Files = [];
		foreach ($Order as $f) {
			if(is_file(DIR_JS.$f))
				$Files[] = CFG_BASE_URL.DIR_JS.$f;
		}
		foreach(scandir(DIR_JS) as $f) {
			if(in_array($f, $Order))
				continue;
			if(preg_match('/\.js$/', $f)) {
				$Files[] = CFG_BASE_URL.DIR_JS.$f;
			}
		}
		return $Files;
	}
}
