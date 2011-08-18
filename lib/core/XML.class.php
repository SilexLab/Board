<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class XML {
	private $XML;
	
	public function __construct($File, $IsString = false) {
		if($IsString) {
			$this->XML = simplexml_load_string($File);
		} else {
			$this->XML = simplexml_load_file($File);
		}
	}
	
	public function XPath($Path) {
		$Strings = array();
		foreach($this->XML->xpath($Path) as $String) {
			$Strings[] = $String;
		}
	}
	
	public static function ReadElement($File, $Element) {
		$XML = simplexml_load_file($File);
		return $XML->xpath($Element);
		//return sizeof($String) == 1 ? $String[0] : $String;
	}
}
?>