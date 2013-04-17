<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SecureUtil {
	/**
	 * Encrypt a password
	 * @param   string  $Password
	 * @param   string  $Email
	 * @param   string  $Rounds
	 * @return  string
	 */
	public static function EncryptPassword($Password, $Email, $Rounds = '08') {
		$Hash = hash_hmac('whirlpool', str_pad($Password, strlen($Password) * 4, sha1($Email), STR_PAD_BOTH), CFG_SALT, true);
		$Salt = substr(str_shuffle('./0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 22);
		return crypt($Hash, '$2a$'.$Rounds.'$'.$Salt);
	}

	/**
	 * Compare the password and e-mail with the encrypted
	 * @param   string  $Password
	 * @param   string  $Email
	 * @param   string  $Stored     The encrypted password
	 * @return  bool
	 */
	public static function CheckPassword($Password, $Email, $Stored) {
		$Hash = hash_hmac('whirlpool', str_pad($Password, strlen($Password) * 4, sha1($Email), STR_PAD_BOTH), CFG_SALT, true);
		return crypt($Hash, substr($Stored, 0, 30)) == $Stored;
	}
}
