<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface AutoloaderInterface {	
	/**
	 * Register an Directory to search into for classes
	 */
	public static function AddDir($Directory);
	
	/**
	 * Function wich will registered as an Autoloader
	 */
	public static function Autoload($Class);
}
?>