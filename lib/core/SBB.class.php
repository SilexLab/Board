<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class SBB {
	// Objects / Variables
	private static $Language;
	private static $PageInfo;
	
	public static function Load() {
		Config::Get();
		Style::Load();
		self::$Language = new Language();
		self::$PageInfo = new PageInfo();
		Page::Initial();
		Menu::Render();
	}
	
	// Core Functions
	public static function CreateConstant($Name, $Value) {
		define(strtoupper($Name), $Value);
	}
	
	// Object / Variable access
	public static function Language() {
		return self::$Language;
	}
	public static function PageInfo() {
		return self::$PageInfo;
	}
}
?>