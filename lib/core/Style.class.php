<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Style implements Singleton {
	private static $Instance = NULL;

	// Styleinfo
	private $Info = array();
	private $Files = array();
	
	public static function GetInstance() {
		if(!self::$Instance)
			self::$Instance = new self;
		return self::$Instance;
	}
	
	private function __clone() {}
	
	protected function __construct() {
		$this->Info['Name'] = SBB::Config('config.style.default'); // TODO: Read Userstyles
		
		// Set CSS and JS files
		$this->Files = array(
			'CSS' => $this->GetCSS(),
			'JS' => $this->GetJS()
		);
		
		// TODO: Load style info.xml and save in $this->Style
		
		// Set more infos
		$this->Info['Files'] = $this->Files;
		$this->Info['TPL'] = DIR_STYLE.$this->Info['Name'].'/'.DIR_TPL;
	}
	
	/**
	 * Returns the style info
	 * @param	string	$Value
	 */
	public function Info($Value = '') {
		return !$Value ? $this->Info : (isset($this->Info[$Value]) ? $this->Info[$Value] : false);
	}
	
	/**
	 * Returns the style files
	 * @param	string	$Type
	 */
	public function Files($Type = '') {
		return !$Type ? $this->Files : (isset($this->Files[$Type]) ? $this->Files[$Type] : false);
	}
	
	// TODO: Merge GetCSS() and GetJS()
	protected function GetCSS() {
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Info['Name']);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Info['Name'].'" doesn\'t exist');
		else {
			$Files = array();
			foreach($Dir as $File) {
				// Extension is .css?
				if(strpos($File, '.css') === (strlen($File) - 4))
					$Files[] = $File;
			}
			return $Files;
		}
	}
	
	protected function GetJS() {
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Info['Name'].'/'.DIR_JS);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Info['Name'].'/'.DIR_JS.'" doesn\'t exist');
		else {
			$Files = array();
			foreach($Dir as $File) {
				// Extension is .js?
				if(strpos($File, '.js') === (strlen($File) - 3))
					$Files[] = $File;
			}
			return $Files;
		}
	}
}
?>