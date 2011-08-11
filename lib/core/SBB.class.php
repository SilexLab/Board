<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

require_once('SBB.interface.php');
require_once('Autoloader.class.php');

class SBB /*implements SBBInterface*/ { // Dunno why this Interface let the Autoloaderclass forgot that the SBB Class exist...
	private static $Database;
	
	public static function Load() {
		if(defined('CLASS_SBB'))
			return false;
		define('CLASS_SBB', '');
		
		Autoloader::Register();
		self::$Database = Database::GetDatabase();
		self::SQL()->Connect();
		Config::CreateConstants();
	}
	
	public static function SQL() {
		return self::$Database;
	}
}
	
	
	/*
	// Objects / Variables
	private static $Language;
	private static $PageInfo;
	
	public static function Load() {
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
	}*/
?>