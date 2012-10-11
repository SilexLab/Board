<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * A wrapper for Smarty
 */

require_once(DIR_LIB.'smarty/Smarty.class.php');
class Template {
	private
		$Smarty,
		$Vars;

	public function __construct($TplDir, $StylePath = null) {
		$this->Smarty = new Smarty();
		
		//$this->Smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
		$this->Smarty->setTemplateDir($StylePath ? [$StylePath, $TplDir] : $TplDir);
		$this->Smarty->setCompileDir(DIR_TPLC);
		$this->Smarty->setCacheDir(CFG_CACHE_DIR); //self::Config('system.cache.dir')
	}

	/**
	 * Assign a key and a value as a variable to the variable pool
	 * @param	string	$Key
	 * @param	mixed	$Value
	 */
	public function Assign($Var, $Overwrite = false) {
		$this->Smarty->assign($Var);
	}

	/**
	 * Parses and render the template (starting with the given template) and returns the final product as a string
	 * @param	string	$Template
	 * @return	string
	 */
	// public function Render($Template) {
	// 	return $this->Parse($Template, false);
	// }
	
	/**
	 * Does the same as Render() but it outputs the template and doesn't return anything
	 * @param	string	$Template
	 */
	public function Display($Template) {
		$this->Smarty->display($Template);
	}
}
