<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Language {
	private static $Language;

	private static $DefaultLanguage;

	private static $Items = [];

	private static $AvailableLanguages = [];

	/**
	 * Get the current language
	 * @return	void
	 */
	public static function Initialize($L = '') {
		// Do not initialize if already
		if(!empty(self::$Language))
			return;

		// Get the default language
		self::$DefaultLanguage = SBB::Config('page.language.default');

		/* Find a language to use */
		// Use $L if exists
		if($L && is_dir(DIR_LANGUAGE.$L))
			self::$Language = $L;
		// TODO: Get the user language
		// Use the default language if it's still unset
		if(empty(self::$Language))
			self::$Language = self::$DefaultLanguage;

		/* Validate the language */
		// If it's still empty, fuck you, ok?
		if(empty(self::$Language))
			throw new DatabaseException('Failed to load the default language');
		if(!is_file(DIR_LANGUAGE.self::$Language.'/info.xml'))
			throw new SystemException('"'.self::$Language.'" ("'.$Dir.'") is not a language');

		/* Load the language */
		if(self::LoadFiles() === 0)
			throw new SystemException('No language files could be loaded from "'.$Dir.'"');
	}

	/**
	 * Returns the available languages
	 * @return  array
	 */
	public static function Available() {
		// TODO: First read from db
		if(empty(self::$AvailableLanguages)) {
			foreach(scandir(DIR_LANGUAGE) as $Language) {
				if(is_dir(DIR_LANGUAGE.$Language) && !in_array($Language, ['.', '..'])) {
					if(file_exists(DIR_LANGUAGE.$Language.'/info.xml')) {
						$Name = XML::ReadElement(DIR_LANGUAGE.$Lang.'/info.xml', 'name');
						self::$AvailableLanguages[$Language] = (string)$Name[0];

						// save results in db
						$Encoding = XML::ReadElement(DIR_LANGUAGE.$Lang.'/info.xml', 'encoding');

						$STMT = SBB::DB()->prepare('REPLACE INTO `language` (`Abbreviation`, `Encoding`) VALUES (:Abbreviation, :Encoding)');
						$STMT->execute([':Abbreviation' => $Lang, ':Encoding' => (string)$Encoding[0]]);
					}
				}
			}
		}
		return self::$AvailableLanguages;
	}

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
	 * Load all language files
	 * @return  int
	 */
	private static function LoadFiles() {
		$Dir = DIR_LANGUAGE.self::$Language.'/';
		$FilesLoaded = 0;
		foreach(scandir($Dir) as $File) {
			if(is_file($Dir.$File) && (preg_match('/^(.+)\.php$/', $File))) {
				self::$Items = array_merge(self::$Items, include($Dir.$File));
				$FilesLoaded++;
			}
		}
		return $FilesLoaded;
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
			return include($Path);
	}
}
