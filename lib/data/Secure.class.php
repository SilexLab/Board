<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Secure {
	public static function EncryptPassword($Password, $Salt) {
		return sha1($Salt.md5($Salt.sha1($Password.md5($Salt))));
	}
	
	public static function EncryptSalt() {
		return sha1(md5(base64_encode(microtime())));
	}
}
