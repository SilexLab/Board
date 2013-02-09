<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SessionGarbageCollector {
	/**
	 * Check user circumstances and clear not necessary entries
	 */
	public function __construct() {
		if(!isset($_SESSION))
			return;
		if(SBB::User()->LoggedIn()) {
			foreach ($_SESSION as $Key => $Value) {
				if(strpos($Key, 'register.') !== false) {
					Session::Remove($Key);
				}
			}
		}
	}
}
