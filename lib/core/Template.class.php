<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * A wrapper for Twig
 */
class Template {
	// Twig stuff
	private $Environment = null, $Template = null, $Variables = array();
	
	// Twig setting variables
	private $CachePath = null, $TPLPath = null, $Debug = false;

	/**
	 * Initialize Twig
	 */
	public function __construct($TPLPath, $StylePath = '', $CachePath = '', $Debug = true,
		$Charset = 'utf-8', $AutoReload = true, $AutoEscape = false) {
		// include the Twig Autoloader and register it
		if(!defined('CLASS_TEMPLATE')) {
			define('CLASS_TEMPLATE', 1);
			require_once (DIR_LIB.'Twig/Autoloader.php');
			Twig_Autoloader::register();
		}
		
		// Set necessary variables
		$this->TPLPath = $StylePath != '' ? array($StylePath, $TPLPath) : $TPLPath;
		$this->CachePath = $CachePath != '' ? $CachePath : (DIR_LIB.'cache/');
		$this->Debug = $Debug;
		
		// Initial the Twig Environment
		$this->Environment = new Twig_Environment(new Twig_Loader_Filesystem($this->TPLPath), array(
			'debug'       => $this->Debug, // Enable or disable debugging
			'charset'     => $Charset, // Sets the charset to the given value
			'cache'       => $this->CachePath, // Sets the cache directory
			'auto_reload' => $AutoReload, // Automaticaly recompile templates (for developing)
			'autoescape'  => $AutoEscape // Enabe auto-escaping
		));
		
	}
	
	/**
	 * Returns the value of the given key
	 * @param	string	$Key
	 */
	public function Get($Key) {
		return isset($this->Variables[$Key]) ? $this->Variables[$Key] : $Key;
	}
	
	/**
	 * Assign an array of Keys and Values to the variable pool of the template
	 * @param	array	$Variable
	 */
	public function Set(array $Variable, $Language = false) {
		foreach($Variable as $Key => $Value) {
			if(is_numeric($Key))
				continue;
			$this->Assign(($Language ? 'lang='.$Key : $Key), $Value);
		}
	}
	
	/**
	 * Adds a path to search for templates
	 * @param	string	$Path
	 */
	public function AddPath($Path) {
		$this->Environment->getLoader()->addPath($Path);
	}
	
	/**
	 * Parses and render the template (starting with the given template) and returns the final product as a string
	 * @param	string	$Template
	 * @return	string
	 */
	public function Render($Template) {
		return $this->Parse($Template, false);
	}
	
	/**
	 * Does the same as Render() but it outputs the template and doesn't return anything
	 * @param	string	$Template
	 */
	public function Display($Template) {
		$this->Parse($Template, true);
	}
	
	/**
	 * Assign a key and a value as a variable to the variable pool
	 * @param	string	$Key
	 * @param	mixed	$Value
	 */
	protected function Assign($Key, $Value) {
		if(isset($this->Variables[$Key]) && is_array($this->Variables[$Key]) && is_array($Value))
			$this->Variables = array_merge_recursive($this->Variables, array($Key => $Value));
		else
			$this->Variables[$Key] = $Value;
	}
	
	/**
	 * @param	string	$Template
	 * @param	bool	$Display
	 */
	protected function Parse($Template, $Display) {
		$this->Template = $this->Environment->loadTemplate($Template);
		if(!$Display)
			return $this->Template->render($this->Variables);
		$this->Template->display($this->Variables);
	}
}
?>