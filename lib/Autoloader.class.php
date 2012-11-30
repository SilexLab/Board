<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Autoloader {
	protected static $Directories = [];
	protected static $Index = [];
	
	/**
	 * Register the autoloader
	 */
	public static function Register() {
		if(!defined('CLASS_AUTOLOADER')) {
			define('CLASS_AUTOLOADER', '');
			
			// Register the "Autoload" function of this "self" class
			spl_autoload_register([new self, 'Autoload']);

			// Register directories, for the autoloader search
			self::$Directories = [
				'core/*',
				'data/*',
				'util/*'
			];

			// Indexing files
			self::IndexFiles();
		}
	}
	
	/**
	 * Add a path to search for classes
	 * @param mixed $Directory
	 */
	public static function AddPath($Directory) {
		if(defined('CLASS_AUTOLOADER')) {
			$Directory = (array)$Directory;
			foreach ($Directory as $Dir) {
				if(!in_array($Dir, self::$Directories)) {
					self::IndexFiles([$Dir]);
					self::$Directories[] = $Dir;
				}
			}
		}
	}
	
	/**
	 * Method to load classes
	 * @param string $Class
	 */
	public static function Autoload($Class) {		
		if(defined('CLASS_AUTOLOADER')) {
			if(isset(self::$Index[$Class]))
				require_once(DIR_LIB.self::$Index[$Class]);
		}
	}

	/**
	 * Indexing a directory
	 * @param array $Directories optional
	 */
	protected static function IndexFiles(array $Directories = []) {
		if(!$Directories)
			$Directories = self::$Directories;

		// Indexing files
		foreach($Directories as $Dir) {
			// Handle wildcard
			if(preg_match('/^(.+\/)\*$/', $Dir, $d)) {
				$Dir = $d[1];
				foreach(scandirr(DIR_LIB.$Dir) as $File) {
					if(is_file(DIR_LIB.$Dir.$File) && preg_match('/([a-zA-Z0-9_]+)\.(class|interface)\.php$/', $File, $m)) {
						if(!isset(self::$Index[$m[1]]))
							self::$Index[$m[1]] = $Dir.$File;
					}
				}
			} else {
				foreach (scandir(DIR_LIB.$Dir) as $File) {
					if(!preg_match('/^(.+)\/$/', $Dir))
						$Dir .= '/';
					if(is_file(DIR_LIB.$File) && preg_match('/([a-zA-Z0-9_]+)\.(class|interface)\.php$/', $File, $m)) {
						if(!isset(self::$Index[$m[1]]))
							self::$Index[$m[1]] = $Dir.$File;
					}
				}
			}
		}
	}
}
