<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Template extends SBB implements TemplateInterface {
	private $Environment, $Variables;
	
	public function __construct($TPLPath    = '',
								$Cache      = '',
								$Debug      = true,
								$Charset    = 'utf-8',
								$AutoReload = true,
								$Autoescape = false)
	{
		if(!defined('CLASS_TEMPLATE')) {
			// Initial Twig
			define('CLASS_TEMPLATE', '');
			require_once(DIR_LIB.'Twig/Autoloader.php');
			Twig_Autoloader::register();
		}
		
		$Cache = $Cache === '' ? DIR_LIB.'cache/' : $Cache;
		$TPLPath = $TPLPath === '' ? DIR_ROOT.DIR_TPL : $TPLPath;
		
		$this->Environment = new Twig_Environment(new Twig_Loader_Filesystem($TPLPath), array(
			'debug'			=> $Debug,		// Enable Debugging
			'charset'		=> $Charset,	// Set the charset to utf-8
			'cache'			=> $Cache,		// Set the cache directory
			'auto_reload'	=> $AutoReload,	// Automaticaly recompile templates (for developing)
			'autoescape'	=> $Autoescape	// Enabe auto-escaping
		));
	}
	
	public function Assign(array $Variables) {
		foreach($Variables as $Var => $Value) {
			$this->DoAssign($Var, $Value);
		}
	}
	
	public function AssignLanguage(array $Variables) {
		foreach($Variables as $Var => $Value) {
			$Var = strpos($Var, 'lang=') === 0 ? $Var : 'lang='.$Var;
			$this->DoAssign($Var, $Value);
		}
	}
	
	public function Render($Template) {
		return $this->Parse($Template, false);
	}
	
	public function Display($Template) {
		$this->Parse($Template, true);
	}
	
	
	private function DoAssign($Var, $Value) {
		// If this variable (array) is already given, merge the value
		if(isset($this->Variables[$Var]) && is_array($this->Variables[$Var]) && is_array($Value)) {
			$this->Variables = array_merge_recursive($this->Variables, array($Var => $Value));
			continue;
		}
		$this->Variables[$Var] = $Value;
	}
	
	private function Parse($Template, $Display = false) {
		$this->GetVariables();
		$Template = $this->Environment->loadTemplate($Template);
		if(!$Display)
			return $Template->render($this->Variables);
		$Template->display($this->Variables);
	}
	
	private function GetVariables() {
		// Pre Parsing - Catch Variables
		$this->Assign(array(
			'CurrentStyle' => Style::GetCurrentStyle(),
			'CSSStyles'    => Style::GetCSS(),
			'Javascripts'  => Style::GetJS())
		);
		Config::CreateVariables();
	}
	
	/* // Currently no need for that
	private function StringToArray(&$Var, &$Value) {
		$Arrays = explode('.', $Var);
		$TempValue = array();
		while(sizeof($Arrays) - 1)
			$TempValue = array(array_pop($Arrays) => empty($TempValue) ? $Value : $TempValue);
		$Var = $Arrays[0];
		$Value = $TempValue;
	}
	*/
}
?>