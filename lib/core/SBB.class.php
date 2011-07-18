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
		Style::Load();
		self::$Language = new Language();
		Menu::Render();
		Page::Initial();
	}
	
	public static function Language() {
		return self::$Language;
	}
}
?>