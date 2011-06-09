<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 8
 */

class language {
	private $Languages = array();
	
	public $Items = array();
	public $Default = 'DE';
	public $Language;
	
	public function __construct() {
		if(isset($_SESSION['userid'])) {
			mysql::Select('users', 'Language', 'ID="'.session::read('userid').'"');
			$this->Language = mysql::FetchObject()->Language;
		} else if(isset($_COOKIE['sbb_lang']))
			$this->Language = $_COOKIE['sbb_lang'];
		
		if(!empty($this->Language) && is_file(PATH_LANGUAGE.$this->Language.'.php'))
			include(PATH_LANGUAGE.$this->Language.'.php');
		else if(is_file(PATH_LANGUAGE.$this->Default.'.php'))
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
		if(empty($this->Languages))
		{
			foreach(scandir(PATH_LANGUAGE) as $File) {
				if(is_file(PATH_LANGUAGE.$File)) {
					$Name = str_replace('.php', '', $File);
					$GL = new GetLang($File);
					$this->Languages[$Name] = $GL->GetName();
				}
			}
		}
		return $this->Languages;
	}
	
	public static function ChangeLang($File) {	
		if(isset($_SESSION['userid'])) {
			$update	= array('Language' => $File);	
			mysql::Update('users', $update, 'ID="'.session::read('userid').'"');
		} else {
			setcookie('sbb_lang', $File, time()+60*60*24*365);
		}
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