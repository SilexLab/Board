<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface StyleInterface {
	/**
	 * Return all Javascripts
	 */
	public static function GetJS();
	
	/**
	 * Return all Cascading Style Sheets
	 */
	public static function GetCSS();
	
	/**
	 * Returns the current used style
	 */
	public static function GetCurrentStyle();
}
?>