<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

require_once('Autoloader.interface.php');

class Autoloader extends SBB implements AutoloaderInterface {
	private static $Directories;
	
	/**
	 * Register the Silex Board Autoloader
	 */
	protected static function Register() {
		// Do not register twice
		if(!defined('CLASS_AUTOLOADER')) {
			define('CLASS_AUTOLOADER', '');
			
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
	
	public static function AddDir($Directory) {
		if(defined('CLASS_AUTOLOADER'))
			self::$Directories[] = $Directory;
		else die('You can not register a directory for the Autoloader class when this class isn\'t initialed.');
	}
	
	public static function Autoload($Class) {
		if(defined('CLASS_AUTOLOADER')) {
			$Type = 'class';
			if(strpos($Class, 'Interface') !== false) { // Interfaces
				$Class = str_ireplace('Interface', '', $Class);
				$Type = 'interface';
			}
			
			foreach(self::$Directories as $Directory) {
				if(file_exists($File = DIR_LIB.$Directory.$Class.'.'.$Type.'.php'))
					include_once($File);
			}
		} else die('Do not use the Autoloader without registering the class.');
	}
}
?>