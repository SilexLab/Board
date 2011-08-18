<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Language {
	/* Saves the Current Language */
	private static $Language;
	/* Saves all languageitems */
	private static $Items = array();
	/* Saves all available languages */
	private static $Languages = array();
	
	public static function Get($Key) {
		return isset(self::$Items[$Key]) ? self::$Items[$Key] : $Key;
	}
	
	public static function Assign() {
		SBB::Template()->AssignLanguage(self::$Items);
	}
	
	public static function LanguageList() {
		foreach(scandir(DIR_LANGUAGE) as $Lang) {
			if(is_dir(DIR_LANGUAGE.$Lang) && !($Lang == '.' || $Lang == '..')) {
				if(file_exists(DIR_LANGUAGE.$Lang.'/info.xml')) {
					$Name = XML::ReadElement(DIR_LANGUAGE.$Lang.'/info.xml', 'name');
					$List[$Lang] = ''.$Name[0];
				}
			}
		}
		return $List;
	}
	
	/**
	 * Search and returns the used language
	 */
	private static function GetLanguage() {
		if(!empty(self::$Language))
			return self::$Language;
		
		/* Find out, wich language should used */
		if(isset($_SESSION['UserID']))
			self::$Language = SBB::SQL()->GetObject()->Select('users', 'Language', 'ID="'.Session::Read('UserID').'"', NULL, 1)->Language;
		else if(isset($_COOKIE['SBB_Lang']))
			self::$Language = $_COOKIE['SBB_Lang'];
		
		if(empty(self::$Language))
			self::$Language = SBB::SQL()->GetObject()->Select('language', 'Shortcut', 'Default="1"', NULL, 1)->Shortcut;
		
		return empty(self::$Language) ? false : self::$Language;
	}
}
?>