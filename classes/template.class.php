<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class template {
	private $Vars = array();
	private $Lang = array();
	private $Content;
	
	public $Debug = false;
	public $IsTemplateObject = false;
	public $patVar = '/\{\$(?!:)(.*?)\}/ism';		// {$Varname}		- Palette für Variablen (Diese Variablen stehen in der Datenbank) <- TODO
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
	
	private function Parse() { // TODO: Write this Smarter (It works, but it's ugly)
		$Debug = $this->Debug;
		
		// Remove Comments
		$this->Content = preg_replace($this->patComment, '', $this->Content);
		
		// Parsing Includes
		preg_match_all($this->patTPL, $this->Content, $match);
			for($i = 0; $i < sizeof($match[0]); $i++) {
				$this->Content = preg_replace($this->patTPL, $this->AddTPL($match[1][$i], true), $this->Content, 1);
			} unset($match);
		
		// Parsing Languages
		preg_match_all($this->patLang, $this->Content, $match);
			for($i = 0; $i < sizeof($match[0]); $i++) {
				if(isset($this->Lang[$match[1][$i]]))
					$this->Content = preg_replace($this->patLang, $this->Lang[$match[1][$i]], $this->Content, 1);
				else {
					if(!$Debug)
						$this->Content = preg_replace($this->patLang, '', $this->Content, 1);
					else
						$this->Content = preg_replace($this->patLang, '<span class="ParseError">Can\'t find language string \'<strong></span>'.$match[1][$i].'</strong>\'', $this->Content, 1);
				}
			} unset($match);
		
		// Parsing Vars
		preg_match_all($this->patVar, $this->Content, $match);
			for($i = 0; $i < sizeof($match[0]); $i++) {
				if(isset($this->Vars[$match[1][$i]]))
					$this->Content = preg_replace($this->patVar, $this->Vars[$match[1][$i]], $this->Content, 1);
				else {
					if(!$Debug)
						$this->Content = preg_replace($this->patVar, '', $this->Content, 1);
					else
						$this->Content = preg_replace($this->patVar, '<span class="ParseError">Can\'t find variable \'<strong>'.$match[1][$i].'</strong>\'</span>', $this->Content, 1);
				}
			} unset($match);
		
		// Falls mehr Variablen gefunden wurden, erneut Parsen
		if(preg_match_all($this->patTPL, $this->Content, $match) ||
			preg_match_all($this->patLang, $this->Content, $match) ||
			preg_match_all($this->patVar, $this->Content, $match) ||
			preg_match($this->patComment, $this->Content))
			$this->Parse($Debug);
	}
	
	// Adding Template
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
		$this->Content .= $tpl;
	}
	
	public function GetString($String, $return = false) {
		if($return)
			return $String;
		$this->Content .= $String;
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