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
		if($Rounds >= 4 && $Rounds <= 31)
			echo 'blub';
		$string = hash_hmac('whirlpool', str_pad($Password, strlen($Password) * 4, sha1($Email), STR_PAD_BOTH), CFG_SALT, true);
		$salt   = substr(str_shuffle('./0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 22);
		return crypt($string, '$2a$'.$Rounds.'$'.$salt);
	}

	/**
	 * Compare the password and e-mail with the encrypted
	 * @param   string  $Password
	 * @param   string  $Email
	 * @param   string  $Stored     The encrypted password
	 * @return  bool
	 */
	public static function CheckPassword($Password, $Email, $Stored) {
		$string = hash_hmac('whirlpool', str_pad($Password, strlen($Password) * 4, sha1($Email), STR_PAD_BOTH), CFG_SALT, true);
		return crypt($string, substr($Stored, 0, 30)) == $Stored;
	}
	
	public static function MakeSafeString($string) {
        $string = htmlspecialchars($string);
	    $bad = array("=","<", ">", "/","\"","`","~","'","$","%","#");
	    $string = str_replace($bad, "", $string);
        $string = mysql_real_escape_string(trim($string));
        return $string;
    }
}