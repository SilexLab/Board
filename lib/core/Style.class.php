<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class Style {
	private static $Default = 'Standard';
	private static $Style;
	
	public static function Load() {
		// TODO: Read used style from Database and use it
		if(empty(self::$Style))
			self::$Style = self::$Default;
		
		Template::Assign(array(
			'CurrentStyle' => self::$Style,
			'CSSStyles' => self::IncludeCSS(),
			'Javascripts' => self::IncludeJS()
		));
	}
	
	private static function IncludeJS() {
		$Style = self::$Style;
		
		$Javascripts = array();
		$Multi = false;
		foreach(scandir(DIR_STYLE.$Style.'/'.DIR_JS) as $File) {
			if(is_file(DIR_STYLE.$Style.'/'.DIR_JS.$File) && (strpos($File, '.js') !== false)) {
				$Javascripts[] = $File;
			}
		}
		return $Javascripts;
	}
	
	private static function IncludeCSS() {
		$Style = self::$Style;
		
		$Styles = array();
		$Multi = false;
		foreach(scandir(DIR_STYLE.$Style.'/') as $File) {
			if(is_file(DIR_STYLE.$Style.'/'.$File) && (strpos($File, '.css') !== false)) {
				$Styles[] = $File;
			}
		}
		return $Styles;
	}
}
?>