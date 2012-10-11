<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Language {
	private static $Language;

	private static $Items = array();

	private static $AvailableLanguages = array();

	/**
	 * Returns the value of a given language node
	 * if none node is given it returns all items
	 * @param	string	$Node
	 * @return	string
	 */
	public static function Get($Node = '') {
		if(!$Node)
			return self::$Items;
		return isset(self::$Items[$Node]) ? self::$Items[$Node] : $Node;
	}

	/**
	 * Get the current language
	 * @return	void
	 */
	public static function Initialize($L = '') {
		if(!empty(self::$Language))
			return;
		
		// TODO: Read the User Language
		/*
			USER LANGUAGE
			-> User::Language()?
		*/
		
		if(is_dir(DIR_LANGUAGE.$L.'/'))
			self::$Language = $L;

		// Use the default language when no language was set until this point
		if(empty(self::$Language))
			self::$Language = SBB::Config('page.language.default');
		
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

						$STMT = SBB::DB()->prepare('REPLACE INTO `language` (`Shortcut`, `Encoding`) VALUES (:Shortcut, :Encoding)');
						$STMT->execute([':Shortcut' => $Lang, ':Encoding' => (string)$Encoding[0]]);
					}
				}
			}
		}
		return self::$AvailableLanguages;
	}

	/**
	 * With this, loaded files can load other files (from other languages)
	 * @param string $Language
	 * @param string $File
	 */
	private static function Load($Language, $File) {
		if($Language == self::$Language)
			return;
		$Path = DIR_LANGUAGE.$Language.'/'.$File;
		if(file_exists($Path))
			require($Path);
	}
}
