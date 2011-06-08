<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

class language {
	private $Languages = array();
	
	public $Items = array();
	public $Default = 'DE';
	
	public function __construct() {
		if(isset($_SESSION['username'])) {
			$language = mysql::FetchObject(mysql::Select('users', 'Language', 'UserName="'.session::read('username').'"'))->Language;
		}
		
		if(isset($language)) {
			$this->Default = $language;	
		}
		
		include(PATH_LANGUAGE.$this->Default.'.php');
	}
	
	public function Get($Key) {
		return $this->Items[$Key];
	}
	
	/* Assign to the Template Object */
	public function Assign($TemplateObject) {
		if($TemplateObject->IsTemplateObject)
			$TemplateObject->AssignLanguage($this->Items);
	}
	
	/* This function slow down the Page, use it carefully! */
	public function GetLanguages() {
		foreach(scandir(PATH_LANGUAGE) as $File) {
			if(is_file(PATH_LANGUAGE.$File)) {
				$Name = str_replace('.php', '', $File);
				$GL = new GetLang($File);
				$this->Languages[$Name] = $GL->GetName();
			}
		}
		return $this->Languages;
	}
}

class GetLang {
	public $Items = array();
	
	public function __construct($File) {
		include(PATH_LANGUAGE.$File);
	}
	
	public function GetName() {
		return $this->Items['com.sbb.language'];
	}
}
?>