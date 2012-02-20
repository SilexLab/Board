<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Autoloader {
	protected static $Directories = array();
	
	/**
	 * Register the autoloader
	 */
	public static function Register() {
		if(!defined('CLASS_AUTOLOADER')) {
			define('CLASS_AUTOLOADER', '');
			
			// Register the "Autoload" function of this "self" class
			spl_autoload_register(array(new self, 'Autoload'));
		}
		
		// Register directories, for the autoloader search
		self::$Directories = array(
			'core/*',
			'data/*'
		);
	}
	
	/**
	 * Add a path to search for classes
	 */
	public static function AddPath($Directory) {
		if(defined('CLASS_AUTOLOADER'))
			if(!in_array($Directory, self::$Directories)) {
				if(strpos($Directory, '/', strlen($Directory) - 1) === false)
					$Directory .= '/';
				self::$Directories[] = $Directory;
			}
	}
	
	/**
	 * Method to load classes
	 */
	public static function Autoload($Class) {
		// Do not search for Twig-Classes
		if(strpos($class, 'Twig') === 0)
			return;
		
		if(defined('CLASS_AUTOLOADER')) {
			foreach(self::$Directories as $Directory) {
				// if a Wildcard appears, handle it
				if(strpos($Directory, '*') !== false) {
					self::HandleWildcard($Directory);
					self::Autoload($Class);
				}
				if(file_exists($File = DIR_LIB.$Directory.$Class.'.class.php')) {
					include_once($File);
					break;
				}
			}
		}
	}
	
	/**
	 * Additional method to handle wildcard directories
	 */
	protected static function HandleWildcard($Dir) {
		// Wildcard on the last position
		if(strpos($Dir, '*') === strlen($Dir) - 1) {
			unset(self::$Directories[array_search($Dir, self::$Directories)]);
			$Dir = substr($Dir, 0, -1);
			$Files = scandirr(DIR_LIB.$Dir);
			foreach($Files as $F) {
				self::AddPath(dirname($Dir.$F));
			}
		}
	}
}
?>