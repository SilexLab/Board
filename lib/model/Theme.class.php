<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Theme {
	const INFO_FILE = 'info.xml';
	
	private $Script;

	private $Info = [];
	private $Properties = [];
	private $Files = [];
	
	private function __clone() {}
	
	public function __construct() {
		/* Get the style */

		// Try the user style
		if(!$this->Validate(SBB::User()->Info('style'))) {
			// Try the default style
			if(!$this->Validate(SBB::Config('theme.default'))) {
				// No default style? well... then search for a random style
				$StyleDir = scandir(DIR_THEME);
				if(!$StyleDir)
					throw new SystemException('Probably your style directory ('.DIR_THEME.') is missing. Please create it and install a theme.');
				foreach($StyleDir as $Style) {
					if(in_array($Style, ['.', '..']))
						continue;
					// Finaly found a style?
					if($this->Validate($Style))
						break;
				}
			}
		}
		// Nothing to do here
		if(empty($this->Info['dir']))
			throw new SystemException('No styles are found in '.DIR_THEME.'. Please install a theme.');

		// Is there a script?
		if(!empty($this->Properties['script'])) {
			require_once($this->Info['dir'].$this->Properties['script']);
			$this->Script = new StyleScript($this->Info, $this->Properties);
			if(!($this->Script instanceof IStyleScript))
				throw new SystemException('The script ('.$this->Properties['script'].') for the "'.$this->Info['name'].'" isn\' a valid style script');
			$this->Files = (array)$this->Script->GetFiles();
		}
		// No script or empty result?
		if(empty($this->Files))
			$this->Files = $this->GetFiles();

		// For everyone
		$this->Info['files'] =& $this->Files;

		$this->Info['logo'] = $this->Info['dir'].'/images/logo.png'; // TODO: get from DB

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
	
	/**
	 * Check if there is a Style
	 * @param   string  $Dir
	 * @return  bool
	 */
	protected function Validate($Style) {
		if(!empty($Style)) {
			$Dir = DIR_THEME.$Style.'/';
			if(is_file($Dir.self::INFO_FILE)) {
				/* Fetching the style info */
				$XML = new XML($Dir.self::INFO_FILE);
				$this->Info['name'] = (string)$XML->info->name;
				if(empty($this->Info['name']))
					$this->Info['name'] = $Style;
				$this->Info['description'] = (string)$XML->info->description;
				$this->Info['website'] = (string)$XML->info->website;
				$this->Info['version'] = (string)$XML->info->version;

				// Additional info
				$this->Info['dir'] = $Dir;
				$this->Info['url'] = CFG_BASE_URL.DIR_THEME.rawurlencode($Style).'/';

				// Style properties
				// Is there a script file?
				if(SBB::Config('theme.allow_scripts'))
					$this->Properties['script'] = (string)$XML->properties->script;
				if(empty($this->Properties['script'])) {
					// Should I order the files?
					foreach($XML->properties->order->css->children() as $c)
						$this->Properties['order']['css'][] = (string)$c;
					foreach($XML->properties->order->js->children() as $c)
						$this->Properties['order']['js'][] = (string)$c;
				}
				return true;
			}
		}
		return false;
	}

	/**
	 * Get css and js files
	 * @return  array
	 */
	protected function GetFiles() {
		// Gimme your files, naw!
		$Files = [];

		/* Get the files */
		foreach(['css', 'js'] as $i) {
			$UrlPath = $this->Info['url'].($i == 'js' ? DIR_JS : '');
			$Path = $this->Info['dir'].($i == 'js' ? DIR_JS : '');

			// Get ordered files
			if(!empty($this->Properties['order'][$i])) {
				foreach($this->Properties['order'][$i] as $f) {
					// TODO: add media for css from info.xml
					if(is_file($Path.$f))
						$Files[$i][] = $i == 'css' ? ['file' => $UrlPath.$f] : $UrlPath.$f;
				}
			}

			// Get the rest
			foreach(scandir($Path) as $f) {
				if(in_array($f, (array)$this->Properties['order'][$i]))
					continue;

				// Can I has files?
				if(preg_match('/\.'.$i.'$/', $f)) // TODO: add media for css from info.xml
					$Files[$i][] = $i == 'css' ? ['file' => $UrlPath.$f] : $UrlPath.$f;
			}
		}

		return $Files;
	}
}
