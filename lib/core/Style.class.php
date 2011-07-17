<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class style {
	// TODO: Benutzten Style aus der DB auslesen und Je nachdem den Ordner wechseln.
	static $Default = 'Standard';
	private static $Style;
	
	public static function IncludeJS() {
		if(empty(self::$Style))
			self::$Style = self::$Default;
		
		$Style = self::$Style;
		
		$Javascripts = array();
		$Multi = false;
		foreach(scandir(DIR_STYLE.$Style.DIR_JS) as $File) {
			if(is_file(DIR_STYLE.$Style.DIR_JS.$File) && (strpos($File, '.js') !== false)) {				
				$Javascripts[] = $File;
			}
		}
		return $Javascripts;
	}
	
	public static function IncludeCSS() {
		if(empty(self::$Style))
			self::$Style = self::$Default;
		
		$Style = self::$Style;
		
		$Styles = array();
		$Multi = false;
		foreach(scandir(DIR_STYLE.$Style) as $File) {
			if(is_file(DIR_STYLE.$Style.$File) && (strpos($File, '.css') !== false)) {				
				$Styles[] = $File;
			}
		}
		return $Styles;
	}
}
?>