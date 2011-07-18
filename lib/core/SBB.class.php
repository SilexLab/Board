<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class SBB {
	// Objects
	private static $Language;
	
	public static function Load() {
		Config::Get();
		Style::Load();
		self::$Language = new Language();
		Menu::Render();
		Page::Initial();
	}
	
	// Core Functions
	public static function CreateConstant($Name, $Value) {
		define(strtoupper($Name), $Value);
	}
	
	// Variable/Object access
	public static function Language() {
		return self::$Language;
	}
}
?>