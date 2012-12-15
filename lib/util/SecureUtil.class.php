<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SecureUtil {

	public static function EncryptPassword($Password, $Email, $Rounds = '08') {

		$string = hash_hmac("whirlpool", str_pad($Password, strlen($Password) * 4, sha1($Email), STR_PAD_BOTH), SALT, true);
		$salt   = substr(str_shuffle('./0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 22);
		return crypt($string, '$2a$'.$Rounds.'$'.$salt);

	}

	public static function CheckPassword($Password, $Email, $Stored) {

		$string = hash_hmac("whirlpool", str_pad($Password, strlen($Password) * 4, sha1($Email), STR_PAD_BOTH), SALT, true);
		return crypt($string, substr($Stored, 0, 30)) == $Stored;

	}

}

//var_dump(SecureUtil::EncryptPassword('abc123abc7', 'ozzy2345de@gmail.com', '12'));