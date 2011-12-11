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
		$InfoFile = DIR_STYLE.$Style.'/info.xml';
		if(!file_exists($InfoFile))
			echo('Could not open the info file');
		else {
			if(! $xml = @simplexml_load_file($InfoFile)) {
				echo('Parsing error');
			} else {
				$StyleInfo['name'] = $xml->info->name;
				$StyleInfo['author'] = $xml->info->author;
				$StyleInfo['website'] = $xml->info->website;
				$StyleInfo['license'] = $xml->info->license;
				$StyleInfo['version'] = $xml->info->version;
				foreach($xml->files->file as $File) {
					if(is_file(DIR_STYLE.$Style.'/'.$File) && (strpos($File, '.css') !== false)) {
						$Styles[] = $File;
					}
				}
				//print_r($xml);	
			}
		}
			
		/*foreach(scandir(DIR_STYLE.$Style.'/') as $File) {
			if(is_file(DIR_STYLE.$Style.'/'.$File) && (strpos($File, '.css') !== false)) {
				$Styles[] = $File;
			}
		}*/
		return $Styles;
	}
	
	public static function GetStyles() {
		$StyleList = array();
		foreach(scandir(DIR_STYLE) as $Dir) {
			if(is_dir($Dir).'/' && $Dir != '.' && $Dir != '..') {
				if(! $xml = @simplexml_load_file(DIR_STYLE.$Dir.'/info.xml')) {
					echo('Parsing error');
				} else {
					$StyleList[] = $xml->info->name;	
				}
			}
		}
		return $StyleList;
	}
	
	public static function GetCurrentStyle() {
		self::Check();
		return self::$Style;
	}
	
	public static function Check() {
		if(empty(self::$Default))
			self::$Default = SBB::Config('config.style.default');
		
		// TODO: Read user style from Database and use it
		if(empty(self::$Style))
			self::$Style = self::$Default;
	}
}
?>