<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * A wrapper for Smarty for Silex Board
 */
require_once(DIR_LIB.'smarty/Smarty.class.php');
class Template {
	private $Smarty;
	private $TemplateDirectories;
	private $Cache;

	public function __construct($Directory = [], $Cache = true) {
		$this->TemplateDirectories = (array)$Directory;
		$this->Cache = $Cache;
		$this->Smarty = new Smarty();
	}

	/**
	 * Add a directory to search for templates
	 * @param   mixed   $Directory
	 * @param   bool    $Primary    optional
	 */
	public function AddDir($Directory, $Primary = true) {
		if($Primary)
			$this->TemplateDirectories = array_merge((array)$Directory, $this->TemplateDirectories);
		else
			$this->TemplateDirectories = array_merge($this->TemplateDirectories, (array)$Directory);
	}

	/**
	 * Assign a key and value pair to the template variable pool
	 * @param   array   $Var
	 * @param   bool    $Overwrite  optional
	 */
	public function Assign(array $Var, $Overwrite = false) {
		$this->Smarty->assign($Var);
	}

	/**
	 * Parse and return the rendered template as string
	 * @param   string  $Template
	 * @return  string
	 */
	public function Render($Template) {
		return $this->Smarty->fetch($Template);
	}
	
	/**
	 * Does the same as Render() but outputs the template and doesn't return anything
	 * @param	string	$Template
	 */
	public function Display($Template) {
		/* Set settings */
		//$this->Smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
		$this->Smarty->setTemplateDir($this->TemplateDirectories);
		if($this->Cache) {
			$this->Smarty->setCompileDir(DIR_TPLC);
			$this->Smarty->setCacheDir(CFG_CACHE_DIR); //self::Config('system.cache.dir')
		}

		/* Display the compiled template */
		$this->Smarty->display($Template);
	}
}
