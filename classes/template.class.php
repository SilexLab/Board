<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 6
 */

class template {
	private $Vars = array();
	private $Lang = array();
	private $Content;
	
	public $Debug = false;
	public $IsTemplateObject = false;
	public $patVar = '/\{\$(?!:)(.*?)\}/ism';		// {$Varname}		- Palette für Variablen (Diese Variablen stehen teilweise in der Datenbank) <- TODO
	public $patLang = '/\{lang\=(.*?)\}/ism';		// {lang=string}	- Palette für Languagestrings (Diese Variablen stehen im Langfile)
	public $patTPL = '/\{\$:(.*?)\}/ism';			// {$:Includefile}	- Palette für Templates (Templates includen)
	public $patComment = '/\{\/\*(.*?)\*\/\}/ism';	// {/* ... */}		- Palette für Kommentare (Kommentare, die nicht ausgegeben werden)
	
	
	function __construct() {
		// Adding Templates setted by construct args
		foreach(func_get_args() as $tpl) {
			$this->AddTPL($tpl);
		} unset($tpl);
		$this->IsTemplateObject = true;
	}
	
	private function ParseIncludes($Content) {
		preg_match_all($this->patTPL, $Content, $match);
		for($i = 0; $i < sizeof($match[0]); $i++) {
			$Content = preg_replace($this->patTPL, $this->AddTPL($match[1][$i], true), $Content, 1);
			
			if(preg_match_all($this->patTPL, $Content, $Buf))
				$Content = $this->ParseIncludes($Content);
			unset($Buf);
		}
		return $Content;
	}
	
	private function ParseLanguages($Content) {
		preg_match_all($this->patLang, $Content, $match);
			for($i = 0; $i < sizeof($match[0]); $i++) {
			$Content = preg_replace($this->patLang, $this->AddLanguage($match[1][$i]), $Content, 1);
			
			if(preg_match_all($this->patLang, $Content, $Buf))
				$Content = $this->ParseLanguages($Content);
			unset($Buf);
		}
		return $Content;
	}
	
	private function ParseVariables($Content) {
		preg_match_all($this->patVar, $Content, $match);
		for($i = 0; $i < sizeof($match[0]); $i++) {
			$Content = preg_replace($this->patVar, $this->AddVariable($match[1][$i]), $Content, 1);
			
			if(preg_match_all($this->patVar, $Content, $Buf))
				$Content = $this->ParseVariables($Content);
			unset($Buf);
		}
		return $Content;
	}
	
	private function Parse() {
		$Debug = $this->Debug;
		
		$this->Content = preg_replace($this->patComment, '', $this->Content); // Remove Comments
		$this->Content = $this->ParseIncludes($this->Content);
		$this->Content = $this->ParseLanguages($this->Content);
		$this->Content = $this->ParseVariables($this->Content);	
		
		if(preg_match_all($this->patComment, $this->Content, $match) ||
			preg_match_all($this->patTPL, $this->Content, $match) ||
			preg_match_all($this->patVar, $this->Content, $match) ||
			preg_match_all($this->patLang, $this->Content, $match))
			$this->Parse();
	}
	
	private function AddLanguage($String) {
		if(isset($this->Lang[$String]))
			return $this->Lang[$String];
		else {
			if(!$Debug)
				return '';
			else
				return '<span class="ParseError">Can\'t find language string \'<strong>'.$String.'</strong>\'</span>';
		}
	}
	
	private function AddVariable($String) {
		if(isset($this->Vars[$String]))
			return $this->Vars[$String];
		else {
			if(!$Debug)
				return '';
			else
				return '<span class="ParseError">Can\'t find variable \'<strong>'.$String.'</strong>\'</span>';
		}
	}
	
	public function AddTPL($template, $return = false) {
		if(!file_exists(PATH_TPL.$template.'.tpl')) {
			if(!$this->Debug)
				$tpl = '';
			else
				$tpl = '<span class="ParseError">Can\'t find template \'<strong>'.$template.'\'</strong></span>';
		} else
			$tpl = file_get_contents(PATH_TPL.$template.'.tpl')."\n";
		
		if($return)
			return $tpl;
		else
			$this->Content .= $tpl;
	}
	
	// Display Templatestructure
	public function Display($return = false, $Debug = false) {
		$this->Debug = $Debug;
		$this->Parse();
		
		if($return)
			return $this->Content;
		else
			echo $this->Content;
	}
	
	// Set var(s) to parse
	public function Assign($var, $value = null) {
		if(is_array($var))
			foreach($var as $key => $value)
				$this->Vars[$key] = $value;
		else
			$this->Vars[$var] = $value;
	}
	
	public function GetVar($var) {
		return isset($this->Vars[$var]) ? $this->Vars[$var] : false;
	}
	
	// Set Languagestring(s) to parse
	public function AssignLanguage($var, $value = null) {
		if(is_array($var))
			foreach($var as $key => $value)
				$this->Lang[$key] = $value;
		else
			$this->Lang[$var] = $value;
	}
}
?>