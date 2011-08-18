<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface SBBInterface {
	/**
	 * Loads the SilexBB Core
	 */
	public static function Load();
	
	/**
	 * Access to the SQL-Database
	 */
	public static function SQL();
	
	public static function Page();
	
	public static function Template();
}
?>