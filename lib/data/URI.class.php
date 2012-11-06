<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class URI {
	protected static $Format;

	protected static $ProtectedArgs = ['lang'];

	protected static $URI;

	/**
	 * [['name', 'value', 'title'], ['name', 'value', 'title']]
	 */
	public static function Make($Data) {
		if(!self::$Format)
			self::$Format = (int)SBB::Config('page.uri_format');

		if(is_array($Data)) {
			switch (self::$Format) {
				case 1:
					// Short URI Format: /Page/Sub?arg=value
					if(isset($_GET['q'])) {
						$Path = $_GET['q'];
						if(strfind($Path, '/')) {}
					}
					break;
				case 2:
					// Long URI Format: /ParentPage/Child/Page/Sub?arg=value
				default:
					// Default URI Format: /?page=page&arg=value
			}
		}
		return $Data;
	}

	public static function Get($Key, $Default = false) {
		if(empty(self::$URI)) {
			if(isset($_GET) && !empty($_GET)) { // Get GET parameters
				foreach($_GET as $k => $v)
					self::$URI[$k] = $v;
			}
			// TODO: Check path
		}
		return array_key_exists($Key, self::$URI) ? self::$URI[$Key] : (strtolower($Default) == 'null' ? null : $Default);
	}
}





// 	protected static
// 		$URI = array();

// 	/**
// 	 * Make a URI from data
// 	 * @param  array $Data
// 	 * @return string
// 	 */
// 	public static function Make($Data) {
// 		if(is_array($Data)) {
// 			switch ((int)SBB::Config('page.uri_format')) {
// 				case 1:  // .../value1/value2... - With rewrite
// 				case 2:  // .../index.php/value1/value2... - without rewrite
// 				default: // .../?key1=value1&key2=value2... - default
// 					return self::MakeDefault($Data);
// 			}
// 		}
// 		return $Data;
// 	}

// 	/**
// 	 * Read the GET or path params of the URL
// 	 * @param  string $Key
// 	 * @return mixed
// 	 */
// 	public static function Get($Key, $Default = false) {
// 		if(empty(self::$URI)) {
// 			if(isset($_GET) && !empty($_GET)) { // Get GET parameters
// 				foreach($_GET as $k => $v)
// 					self::$URI[$k] = $v;
// 			}
// 			// TODO: Check path
// 		}
// 		return array_key_exists($Key, self::$URI) ? self::$URI[$Key] : (strtolower($Default) == 'null' ? null : $Default);
// 	}

// 	protected static function MakeDefault(array $Data) { // TODO: '?page=' as first
// 		// Keep this vars:
// 		foreach(['lang'] as $Var)
// 			if(!isset($Data[$Var]) && isset($_GET[$Var]))
// 				$Data[$Var] = $_GET[$Var];

// 		// Make URI
// 		$URI = '';
// 		$i = 0;
// 		foreach($Data as $Key => $Value) {
// 			if($Key !== 0) {
// 				if($i == 0)
// 					$URI = '?';
// 				$URI .= $Key.'='.$Value.'&amp;';
// 				$i++;
// 			} else if($i == 0) {
// 				$URI = $Value;
// 			}
// 		}
// 		return $i == 0 ? $URI : substr($URI, 0, -5);
// 	}

// 	protected static function MakeWithRewrite(array $Data) {
// 		//
// 		//SBB::Config('page.uri_structure');
// 	}

// 	protected static function MakeWithoutRewrite(array $Data) {
// 		//
// 		//SBB::Config('page.uri_structure');
// 	}
// }
