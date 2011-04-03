<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

class language {
	public $Items = array();
	public $Default = 'DE';
	function __construct() {
		// TODO: Auslesen der Sprache aus der MySQL-Datenbank und includen der selbigen
		include_once(PATH_LANGUAGE.$this->Default.'.php');
	}
	
	/* Assign to the Template Object */
	public function Assign($TemplateObject) {
		if($TemplateObject->IsTemplateObject)
			$TemplateObject->AssignLanguage($this->Items);
	}
}
?>