<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Language {
	private static $Language;

	private static $Items = array();

	private static $AvailableLanguages = array();

	/**
	 * Returns the value of a given language node
	 * @param	string	$Node
	 * @return	string
	 */
	public static function Get($Node) {
		return isset(self::$Items[$Key]) ? self::$Items[$Key] : $Key;
	}

	public static function GetItems() {
		return self::$Items;
	}

	/**
	 * Get the current language
	 * @return	void
	 */
	public static function Initialize() {
		if(!empty(self::$Language))
			return;
		
		// TODO: Read the User Language
		/*
			USER LANGUAGE
			-> User::Language()?
		*/

		// Use the default language
		if(empty(self::$Language)) // TODO: Move the db-entry 'DefaultLanguage' to the Config table
			self::$Language = SBB::DB()->Table('language')->Select('Shortcut')->Where('`DefaultLanguage` = 1')->Limit(1)->Execute()->FetchObject()->Shortcut;
		
		// Include the languagefiles
		if(!empty(self::$Language)) {
			$Dir = DIR_LANGUAGE.self::$Language.'/';
			$FilesLoaded = 0;
			if(is_dir($Dir)) {
				foreach(scandir($Dir) as $File) {
					if(is_file($Dir.$File) && (strpos($File, '.php') === strlen($File) - 4)) {
						require_once($Dir.$File);
						$FilesLoaded++;
					}
				}
				if($FilesLoaded == 0)
					throw new SystemException('No language files are loaded from "'.$Dir.'"');
			} else
				throw new SystemException('"'.$Dir.'" is not a directory');
		} else
			throw new DatabaseException('Failed to load the default language');
	}

	/**
	 * Returns the available languages
	 */
	public static function Available() {
		// TODO: First read from db
		if(empty(self::$AvailableLanguages)) {
			foreach(scandir(DIR_LANGUAGE) as $Language) {
				if(is_dir(DIR_LANGUAGE.$Language) && !in_array($Language, array('.', '..'))) {
					if(file_exists(DIR_LANGUAGE.$Language.'/info.xml')) {
						$Name = XML::ReadElement(DIR_LANGUAGE.$Lang.'/info.xml', 'name');
						self::$AvailableLanguages[$Language] = (string)$Name[0];

						// save results in db
						$Encoding = XML::ReadElement(DIR_LANGUAGE.$Lang.'/info.xml', 'encoding');
						SBB::DB()->Table('language')->Replace(array('Shortcut' => $Lang, 'Encoding' => (string)$Encoding[0]))->Execute();
					}
				}
			}
		}
		return self::$AvailableLanguages;
	}
}
?>