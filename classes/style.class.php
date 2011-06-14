<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

class style {
	// TODO: Benutzten Style aus der DB auslesen und Je nachdem den Ordner wechseln.
	private static $Default = 'Standard';
	private static $Style;
	
	public static function IncludeJS() {
		if(empty(self::$Style))
			self::$Style = self::$Default.'/';
		
		$Style = self::$Style;
		
		$Javascripts = '';
		$Multi = false;
		foreach(scandir(PATH_STYLE.$Style.PATH_JS) as $File) {
			if(is_file(PATH_STYLE.$Style.PATH_JS.$File) && (strpos($File, '.js') !== false)) {
				if($Multi)
					$Javascripts .= "\t";
				else
					$Multi = true;
				
				$Javascripts .= '<script src="'.PATH_STYLE.$Style.PATH_JS.$File.'" type="text/javascript"></script>'."\n";
			}
		}
		return trim($Javascripts, "\n");
	}
	
	public static function IncludeCSS() {
		if(empty(self::$Style))
			self::$Style = self::$Default.'/';
		
		$Style = self::$Style;
		
		$Styles = '';
		$Multi = false;
		foreach(scandir(PATH_STYLE.$Style) as $File) {
			if(is_file(PATH_STYLE.$Style.$File) && (strpos($File, '.css') !== false)) {
				if($Multi)
					$Styles .= "\t";
				else
					$Multi = true;
				
				$Styles .= '<link href="'.PATH_STYLE.$Style.$File.'" rel="stylesheet" type="text/css">'."\n";
			}
		}
		return trim($Styles, "\n");
	}
}
?>