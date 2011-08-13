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
	private static $Language;
	private static $PageInfo;
	
	public static function Load() {
		if(defined('CLASS_SBB'))
			return false;
		define('CLASS_SBB', '');
		
		Autoloader::Register();
		self::$Database = Database::GetDatabase();
		self::SQL()->Connect();
		Config::CreateConstants();
		Template::Initial();
		self::$Language = new Language();
		self::$PageInfo = new PageInfo();
		Page::Initial();
		Menu::Render();
		
		self::TemplateAssign();
		// Compile
		Template::Display('case.tpl');
	}
	
	public static function SQL() {
		return self::$Database;
	}
	
	public static function Language() {
		return self::$Language;
	}
	
	public static function PageInfo() {
		return self::$PageInfo;
	}
	
	private static function TemplateAssign() {
		self::Language()->Assign();
		Template::Assign(array(
			'Site' => 'Seitenname',
			'DIR_STYLE' => DIR_STYLE,
			'DIR_JS' => DIR_JS,
			'Load' => '~Load: '.round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms')
		);
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