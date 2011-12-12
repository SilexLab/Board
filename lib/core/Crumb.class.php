<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Crumb {
	private static $Crumbs = array();
	
	/**
	 * Add a Breadcrumb
	 */
	public static function Add($Title, $Link) {
		self::$Crumbs[] = array('Title' => Language::Get($Title), 'Link' => $Link);
	}
	
	/**
	 * Get all Breadcrumbs
	 */
	public static function Get() {
		return array('Crumbs' => self::$Crumbs);
	}
}
?>