<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class Autoloader {
	private static $Directories;
	
	/**
	 * Register the Silex Board Autoloader
	 */
	public static function Register() {
		// Do not register twice
		if(!defined('CLASS_AUTOLOADER')) {
			define('CLASS_AUTOLOADER', '');
			
			// Define "lib" directory constant
			if(!defined('DIR_LIB'))
				define('DIR_LIB', dirname(__FILE__).'/');
			
			// Register the "Autoload" function of this "self" class
			spl_autoload_register(array(new self, 'Autoload'));
			
			// Register Directories
			self::$Directories = array(
				'acp/',
				'core/',
				'core/database/',
				'data/',
				'data/message/',
				'data/message/pm/',
				'data/message/poll/',
				'data/page/'
			);
		}
	}
	
	/**
	 * Register an Directory to search into for classes
	 */
	public static function AddDir($Dir) {
		if(defined('CLASS_AUTOLOADER'))
			self::$Directories[] = $Dir;
		else die('You can not register a directory for the Autoloader class when this class isn\'t initialed.');
	}
	
	/**
	 * Function wich will registered as an Autoloader
	 */
	public static function Autoload($Class) {
		if(defined('CLASS_AUTOLOADER')) {
			foreach(self::$Directories as $Directory) {
				if(file_exists($File = DIR_LIB.$Directory.$Class.'.class.php'))
					include_once($File);
			}
		} else die('Do not use the Autoloader without registering the class.');
	}
}
?>