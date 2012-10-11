<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SessionGarbageCollector {
	/**
	 * Check user circumstances and clear not necessary entries
	 */
	public static function Collect() {
		if(!isset($_SESSION))
			return;
		foreach($_SESSION as $Key => $Value) {
			// If logged in
			if(SBB::User()->LoggedIn()) {
				// If exists, clear old register stuff
				if(strpos($Key, 'register.') !== false) {
					Session::Remove($Key);
				}
			}
		}
	}
}
