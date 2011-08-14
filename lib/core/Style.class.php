<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Style implements StyleInterface {
	private static $Default, $Style;
	
	public static function GetJS() {
		self::Check();
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
	
	public static function GetCSS() {
		self::Check();
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
	
	public static function GetCurrentStyle() {
		self::Check();
		return self::$Style;
	}
	
	public static function Check() {
		if(empty(self::$Default))
			self::$Default = CFG_STYLE_DEFAULT;
		
		// TODO: Read user style from Database and use it
		if(empty(self::$Style))
			self::$Style = self::$Default;
	}
}
?>