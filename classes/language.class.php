<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class language {
	public $Items = array();
	public $Default = 'DE';
	function __construct() {
		// TODO: Auslesen der Sprache aus der MySQL-Datenbank und includen der selbigen
		include_once(PATH_LANGUAGE.$this->Default.'.php');
	}
	
	public function Get($Key) {
		return $this->Items[$Key];
	}
	
	/* Assign to the Template Object */
	public function Assign($TemplateObject) {
		if($TemplateObject->IsTemplateObject)
			$TemplateObject->AssignLanguage($this->Items);
	}
}
?>