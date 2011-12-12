<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

require_once('Autoloader.class.php');

class SBB {
	// Objects
	private static $Database, $Language, $PageInfo, $Template, $Page, $Config;
	
	public static function Load() {
		if(defined('CLASS_SBB'))
			return false;
		define('CLASS_SBB', '');
		
		Autoloader::Register();
		self::$Database = Database::GetDatabase();
		self::$Config = new Config();
		self::$Template = new Template();
		self::$Page = Page::GetPage();
		Menu::Render();
		
		/*new MessageBox('Test');
		new MessageBox('Test2', MessageBox::ERROR);
		new MessageBox('Test3', MessageBox::WARNING);
		new MessageBox('Test4', MessageBox::SUCCESS);*/
		
		MessageBox::Assign();
		self::TemplateAssign();
		// Compile
		self::Template()->Display('case.tpl');
	}
	
	public static function SQL() {
		return self::$Database;
	}
	
	public static function Page() {
		return self::$Page;
	}
	
	public static function Template() {
		return self::$Template;
	}
	
	public static function Config($Node) {
		return self::$Config->Get($Node);
	}
	
	private static function TemplateAssign() {
		global $GeneratingTime;
		self::Template()->Assign(array(
			'DIR_STYLE' => DIR_STYLE,
			'StyleList' => Style::GetStyles(),
			'DIR_JS' => DIR_JS,
			'User' => User::Get(),
			'Load' => '~Load: '.round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms')
		);
		self::Template()->Assign(Crumb::Get());
		
		self::Template()->AssignLanguage(Language::Assign());
	}
}
?>