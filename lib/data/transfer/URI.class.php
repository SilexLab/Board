<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class URI {
	const FORMAT_ARGUMENTS = 0;
	const FORMAT_SHORT = 1;
	const FORMAT_LONG = 2;

	private static $Format;

	private $URI = [];
	private $Route = [];

	private static $KeepArgs = ['lang'];

	public function __construct() {
		if(!self::$Format)
			self::$Format = (int)SBB::Config('page.uri_format');
	}

	/**
	 * Make an URL from $Data and follow the URI-format
	 * $Data has to be in this format:
	 * [['page', 'Page'], ['Arg1', 'Value1'], ['Arg2', 'Value2'], [...]]
	 * Use $args to don't make a path from an $Data entry, $args format:
	 * ['ID1', 'ID2', [...]]
	 * @param  mixed $Data
	 * @param  array $args optional
	 * @return string
	 */
	public static function Make($Data, array $args = []) {
		if(!self::$Format)
			self::$Format = (int)SBB::Config('page.uri_format');
		$URL = '';
		if(is_array($Data) && $Data[0][0] == 'page') {
			switch (self::$Format) {
				// "Page/Sub?arg=value" - Short URLs
				case 1:
					$Arguments = '';
					for($i = 0; $i < sizeof($Data); $i++) {
						if(!in_array($Data[$i][0], $args)) {
							if($URL)
								$URL .= '/';
							$URL .= $Data[$i][1];
							if(isset($Data[$i][2]))
								$URL .= '-'.self::MakeTitle($Data[$i][2]);
						} else {
							if($Arguments)
								$Arguments .= '&amp;';
							$Arguments .= $Data[$i][0].'='.$Data[$i][1];
						}
					}
					if($Arguments)
						$URL .= '?'.$Arguments;
					break;
				// "Page/SubPage/Sub?arg=value" - Breadcrumbstyle URLs (Not yet implemented)
				case 2:
				// "?page=value&arg=value" - Default URLs
				default:
					for($i = 0; $i < sizeof($Data); $i++) {
						if($i > 0)
							$URL .= '&amp;';
						else
							$URL = '?';
						$URL .= $Data[$i][0].'='.$Data[$i][1];
					}
			}
		} else if(!is_array($Data))
			$URL = $Data;

		// Keep args
		foreach(self::$KeepArgs as $Arg) {
			if(array_key_exists($Arg, $_GET)) {
				if(strfind($URL, '?')) $URL .= '&amp;';
				else $URL .= '?';
				$URL .= $Arg.'='.$_GET[$Arg];
			}
		}

		// Return finished URL
		return CFG_BASE_URL.$URL;
	}

	public static function MakeTitle($Title) {
		return preg_replace('/[^a-zA-Z0-9\-]/', '', str_replace(' ', '-', $Title));
	}

	/**
	 * Get the whole URI as array
	 * @param  string $Arg     optional
	 * @param  mixed  $OnError optional
	 * @return array
	 */
	public function Get($Arg = '', $OnError = false) {
		if(empty($this->URI)) {
			if(self::$Format > 0 && isset($_GET['q'])) {
				$this->Route = explode('/', trim($_GET['q'], '/'));
				unset($_GET['q']);
				$this->URI = $this->Route;
				$this->URI['page'] = $this->Route[0];
				$this->URI = array_merge($this->URI, $_GET);
			} else
				$this->URI = $_GET;
		}
		return !$Arg ? $this->URI : (array_key_exists($Arg, $this->URI) ? $this->URI[$Arg] : (strtolower($OnError) == 'null' ? null : $OnError));
	}

	/**
	 * Get the route only
	 * @return array
	 */
	public function GetRoute() {
		if(empty($this->URI))
			$this->Get();
		return $this->Route;
	}

	/**
	 * Return wich URI format is used
	 * @return int
	 */
	public function Format() {
		return self::$Format;
	}

	/**
	 * Get the ID of the URL
	 * @param  int    $RoutePos
	 * @param  string $Argument
	 * @return int
	 */
	public function GetID($RoutePos, $Argument) {
		if(self::$Format == 1)
			return (int)explode('-', $this->Get($RoutePos, 0))[0];
		return (int)$this->Get($Argument, 0);
	}

	/**
	 * Compares the expected route id with the current one
	 * @param  int    $RoutePos
	 * @param  string $ExpectedTitle
	 * @param  string $Redirect      optional
	 * @return bool
	 */
	public function Check($RoutePos, $ExpectedTitle, $Redirect = '') {
		// We don't have titles in the arguments format
		if($this->Format() == self::FORMAT_ARGUMENTS)
			return true;
		$R = $this->Get($RoutePos);
		$Match = substr($R, strpos($R, '-') + 1) == self::MakeTitle($ExpectedTitle);
		if($Redirect && !$Match)
			header('location: '.$Redirect);
		return $Match;
	}
}
