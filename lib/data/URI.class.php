<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class URI {
	protected static
		$URI = array();

	/**
	 * Make a URI from data
	 * @param  array $Data
	 * @return string
	 */
	public static function Make($Data) {
		if(is_array($Data)) {
			switch ((int)SBB::Config('config.page.uri_format')) {
				case 1:  // .../value1/value2... - With rewrite
				case 2:  // .../index.php/value1/value2... - without rewrite
				default: // .../?key1=value1&key2=value2... - default
					return self::MakeDefault($Data);
			}
		}
		return $Data;
	}

	/**
	 * Read the GET or path params of the URL
	 * @param  string $Key
	 * @return mixed
	 */
	public static function Get($Key, $Default = false) {
		if(empty(self::$URI)) {
			if(isset($_GET) && !empty($_GET)) { // Get GET parameters
				foreach($_GET as $k => $v)
					self::$URI[$k] = $v;
			}
			// TODO: Check path
		}
		return isset(self::$URI[$Key]) ? self::$URI[$Key] : (strtolower($Default) == 'null' ? null : $Default);
	}

	protected static function MakeDefault(array $Data) { // TODO: '?page=' as first
		$URI = '';
		foreach($Data as $Key => $Value)
			$URI .= $Key.'='.$Value.'&';
		return '?'.trim($URI, '&');
	}

	protected static function MakeWitRewrite(array $Data) {
		//
		//SBB::Config('config.page.uri_structure');
	}

	protected static function MakeWithoutRewrite(array $Data) {
		//
		//SBB::Config('config.page.uri_structure');
	}
}