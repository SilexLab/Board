<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		Revision: 11
 */

class Template {
	private static $Environment;
	private static $Variables;
	
	public static function Initial() {
		if(!defined('CLASS_TEMPLATE')) {
			define('CLASS_TEMPLATE', '');
			
			// Initial Twig
			require_once(DIR_LIB.'Twig/Autoloader.php');
			Twig_Autoloader::register();
			
			self::$Environment = new Twig_Environment(new Twig_Loader_Filesystem(DIR_ROOT.DIR_TPL), array(
				'debug'			=> true,				// Enable Debugging
				'charset'		=> 'utf-8',				// Set the charset to utf-8
				'cache'			=> DIR_LIB.'cache/',	// Set the cache directory
				'auto_reload'	=> true,				// Automaticaly recompile templates (for developing)
				'autoescape'	=> true					// Enabe auto-escaping
			));
		}
	}
	
	public static function Assign($Vars) {
		if(is_array($Vars)) {
			foreach($Vars as $Var => $Value) {
				// When a variable with '.'-Delimiters is given, create an array
				if(strpos($Var, '.') !== false) {
					$Arrays = explode('.', $Var);
					$TempValue = array();
					while(sizeof($Arrays) - 1)
						$TempValue = array(array_pop($Arrays) => empty($TempValue) ? $Value : $TempValue);
					$Var = $Arrays[0];
					$Value = $TempValue;
				}
				// When this variable (array) is already given, merge the value
				if(isset(self::$Variables[$Var]) && is_array(self::$Variables[$Var]) && is_array($Value)) {
					array_merge_recursive(self::$Variables[$Var], $Value);
					continue;
				}
				self::$Variables[$Var] = $Value;
			}
		}
	}
	
	public static function Render($Template) {
		return self::LoadAndRender($Template, false);
	}
	
	public static function Display($Template) {
		self::LoadAndRender($Template, true);
	}
	
	private static function LoadAndRender($Template, $Display = false) {
		$Template = Template::$Environment->loadTemplate($Template);
		if(!$Display)
			return $Template->render(self::$Variables);
		$Template->display(self::$Variables);
	}
}
?>