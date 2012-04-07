<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class PostListener {
	// Listen to forms and trigger actions
	public static function Check() {
		// Any POSTs are send?
		if(isset($_POST)) {
			// Login
			if(isset($_POST['Login']) || isset($_POST['Register'])) {
				if($_POST['Register'] == 1) {
					// Redirect to register page
					header('location: ?page=Register');
				} else if($_POST['Register'] == 0 && isset($_POST['Username']) && isset($_POST['Password'])) {
					SBB::User()->Login($_POST['Username'], $_POST['Password'], !empty($_POST['StayLoggedIn']) ? true : false);
				} else {
					throw new SystemException('The loginform don\'t match');
				}
			}
		}
	}
}
?>