<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Style {
	// Styleinfo
	private $Style = array();
	private $Files = array();
	
	public function __construct() {
		$this->Style['Name'] = SBB::Config('config.style.default'); // TODO: Read Userstyles
		
		// Set CSS and JS files
		$this->Files = array(
			'CSS' => $this->GetCSS(),
			'JS' => $this->GetJS()
		);
		
		// TODO: Load style info.xml and save in $this->Style
		
		
		// Assign to Template
		$this->Style['Files'] = $this->Files;
		SBB::Template()->Set(array('Style' => $this->Style));
	}
	
	/**
	 * Returns the style info
	 * @param	string	$Value
	 */
	public function Style($Value = '') {
		return !$Value ? $this->Style : (isset($this->Style[$Value]) ? $this->Style[$Value] : false);
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
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Style['Name']);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Style['Name'].'" doesn\'t exist');
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
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Style['Name'].'/'.DIR_JS);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Style['Name'].'/'.DIR_JS.'" doesn\'t exist');
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