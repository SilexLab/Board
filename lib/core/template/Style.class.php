<?php
/**
 * @author     Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Style implements ISingleton {
	private static $Instance = NULL;

	// Styleinfo
	private $Info = [];
	
	public static function GetInstance() {
		if(!self::$Instance)
			self::$Instance = new self;
		return self::$Instance;
	}
	
	private function __clone() {}
	
	protected function __construct() {
		/* Get the style */

		// Use user style
		$this->Info['style'] = SBB::User()->Info('style');
		$this->Info['dir'] = DIR_STYLE.$this->Info['style'];

		// If no user style, use default
		if(empty($this->Info['style']) || !is_dir($this->Info['dir'])) {
			$this->Info['style'] = SBB::Config('style.default');
			$this->Info['dir'] = DIR_STYLE.$this->Info['style'];

			// If default doesn't exists, search for random styles
			if(empty($this->Info['style']) || !is_dir($this->Info['dir'])) {
				$Styles = scandir(DIR_STYLE);
				if(!$Styles)
					throw new SystemException('Probably your style directory ('.DIR_STYLE.') is missing. Please create it and install a style.');
				foreach($Styles as $Style) {
					if(in_array($Style, ['.', '..']))
						continue;
					if(is_dir(DIR_STYLE.$Style)) {
						if(is_file(DIR_STYLE.$Style.'/info.xml')) {
							$this->Info['style'] = $Style;
							$this->Info['dir'] = DIR_STYLE.$Style;
							break;
						}
					}
				}

				// Nothing to do here
				if(empty($this->Info['style']) || !is_dir($this->Info['dir']))
					throw new SystemException('No styles are found in '.DIR_STYLE.'. Please install a style.');
			}
		}
		$this->Info['dir'] .= '/';

		/* Get the style files */

		// TODO: Read info.xml and fill variables
		$this->Info['name'] = $this->Info['style'];
		$CssProcessor = 'style.php';
		$CssRootFile = 'style.css';
		$JsProcessor = 'js.php';

		$this->Info['files'] = $this->GetFiles($CssProcessor, $JsProcessor, $CssRootFile);

		// Add template directory of the style
		if(is_dir($this->Info['dir'].DIR_TPL))
			SBB::Template()->AddDir($this->Info['dir'].DIR_TPL);
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
	
	protected function GetFiles($CssProcessor = '', $JsProcessor = '', $CssRootFile = 'style.css') {
		// Gimme your files, naw!
		$Files = [];

		/* Get CSS */
		$Dir = $this->Info['dir'];
		$UrlPath = CFG_BASE_URL.DIR_STYLE.rawurlencode($this->Info['style']).'/';

		// May be useful
		$this->Info['url'] = $UrlPath;

		// Is there a CSS preprocessor?
		if(is_file($Dir.$CssProcessor))
			$Files['css'][] = $UrlPath.$CssProcessor;
		// Nope? Well, search for css files
		else {
			if(is_file($Dir.$CssRootFile))
				$Files['css'][] = ['file' => $UrlPath.$CssRootFile];
			foreach (scandir($Dir) as $File) {
				// We no need no root file
				if($File == $CssRootFile)
					continue;

				// Can I has css file?
				if(preg_match('/\.css$/', $File))
					$Files['css'][] = ['file' => $UrlPath.$File]; // TODO: add media from info.xml
			}
		}

		/* Get JS */
		$Dir .= DIR_JS;
		$UrlPath .= DIR_JS;

		// Is there even a javascript directory?
		if(is_dir($Dir)) {
			// Is there a JS preprocessor?
			if(is_file($Dir.$JsProcessor))
				$Files['js'][] = $UrlPath.$JsProcessor;
			// Ok, search for js files
			else {
				foreach (scandir($Dir) as $File) {
					// Can I has js file?
					if(preg_match('/\.js$/', $File))
						$Files['js'][] = $UrlPath.$File;
				}
			}
		}

		var_dump($Files);

		return $Files;
	}


	// TODO: Merge GetCSS() and GetJS()
	protected function GetCSS() {
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Info['dir']);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Info['dir'].'" doesn\'t exist');
		
		$Files = [];
		if(is_file(DIR_ROOT.DIR_STYLE.$this->Info['dir'].'/style.css')) // "root" css file
			$Files[] = str_replace(' ', '%20', DIR_STYLE.$this->Info['dir'].'/style.css');
		foreach($Dir as $File) {
			if($File == 'style.css')
				continue;
			
			// Extension is .css?
			if(strpos($File, '.css') === (strlen($File) - 4))
				$Files[] = str_replace(' ', '%20', DIR_STYLE.$this->Info['dir'].'/'.$File);
		}
		return $Files;
	}
	
	protected function GetJS() {
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Info['dir'].'/'.DIR_JS);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Info['dir'].'/'.DIR_JS.'" doesn\'t exist');
		
		$Files = [];
		foreach($Dir as $File) {
			// Extension is .js?
			if(strpos($File, '.js') === (strlen($File) - 3))
				$Files[] = str_replace(' ', '%20', DIR_STYLE.$this->Info['dir'].'/'.DIR_JS.$File);
		}
		return $Files;
	}
}
