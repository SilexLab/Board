<?php
/**
 * @author    Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright 2011 - 2013 Silex Bulletin Board
 * @license   GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * User stuff
 */
class UserUtil {

	/**
	 * Gets a user object for the username given
	 * @param string $Username The user's username
	 * @return null|User Null on failure
	 */
	public static function GetUserByName($Username) {

		$query = SBB::DB()->prepare('SELECT * FROM `users` WHERE `Username` = :user');
		$query->execute([':user' => $Username]);

		// Success?
		if($query->rowCount() == 1) {
			return new User(User::GIVEN_ROW, $query->fetchObject());
		} else {
			return null;
		}

	}

}
