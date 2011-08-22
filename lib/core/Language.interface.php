<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface LanguageInterface {
	/**
	 * Translate a given languagestring into a normal string if it exists
	 */
	public static function Get($Key);
	
	/**
	 * Assign the languagestrings to the templateengine
	 */
	public static function Assign();
	
	/**
	 * Returns a list of available languages
	 */
	public static function LanguageList();
	
	/**
	 * Change the language for an user
	 */
	public static function Change($Language);
}
?>