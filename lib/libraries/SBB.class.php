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
		/* Initialize */
		self::$Database = Database::GetDatabase();
		self::$Config   = new Config();

		// Set the custom session save handler and start sessions
		Session::Start();

		self::$Template = new Template(DIR_LIB.DIR_TPL, !CFG_DEBUG);
		self::$User     = Session::GetUser();
		self::$Theme    = new Theme();
		self::$Page     = new Page();
		self::$Nav      = new Nav();

		// Post construct
		//

		/* Functions */
		Listener::Check();
		new SessionGarbageCollector();
		Mail::Init();

		/* Pre-output */
		TimeUtil::DateProgress();
		self::AssignDefault();
		self::$Page->Display();
		self::$Nav->Assign();

		/* Output */
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
		return self::$Config->Get($Node);
	}

	/**
	 * Returns the database object
	 * @return PDO
	 */
	public static final function DB() {
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
		return self::$Page;
	}

	/**
	 * Returns the theme object
	 * @return Theme
	 */
	public static final function Theme() {
		return self::$Theme;
	}

	/**
	 * Returns the nav object
	 * @return Nav
	 */
	public static final function Nav() {
		return self::$Nav;
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
		if($e instanceof PDOException) {
			exit('Your database configuration sux.');
		}
		exit($e);
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
		$GP = new GitPayload();
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
				//'version' => SBB_VERSION.'-'.date('Ymd', CommitInfo::Get()),
				//'sha' => CommitInfo::Get('SHA')
				'version' => SBB_VERSION,
				'sha' => $GP->after
			],
			'title' => self::Config('page.title'),
			'base_url' => CFG_BASE_URL,
			'debug' => (bool)CFG_DEBUG
		]);

		/* Put the stored stuff into the template */
		Notification::Assign();
	}

	// TODO: Move me
	private static function GetGlobalJsFiles() {
		$Order = (array)(new XML(DIR_JS.'info.xml'))->file;
		$Files = [];
		foreach($Order as $f) {
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
