<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * Listen to _global_ (that can triggered on each side) events (POST/GET/etc)
 */
class Listener {
	// Listen to forms and trigger actions
	public static function Check() {
		self::CheckPosts();
		//self::CheckNotifications();
	}

	public static function CheckPosts() {
		// Any POSTs are send?
		if(isset($_POST)) {
			// Login
			if(isset($_POST['Login']) || isset($_POST['Register'])) {
				if($_POST['Register'] == 1) {
					if(isset($_POST['Username']) && isset($_POST['Password'])) {
						Session::Set('register.username', $_POST['Username']);
						Session::Set('register.password', $_POST['Password']);
					}
					header('location: '.URI::Make(['page' => 'Register']));
				} else if($_POST['Register'] == 0 && isset($_POST['Username']) && isset($_POST['Password'])) {
					SBB::User()->Login($_POST['Username'], $_POST['Password'], !empty($_POST['StayLoggedIn']) ? true : false);
				} else {
					throw new SystemException('The loginform don\'t match');
				}
			// Logout
			} else if (isset($_POST['Logout'])) {
				SBB::User()->Logout();
			}
		}
	}

	public static function CheckNotifications() { // Experimental!
		if(Session::Get('Notification') && is_array(Session::Get('Notification'))) {
			foreach(Session::Get('Notification') as $Notification) {
				Notification::Show(Language::Get($Notification[0]), $Notification[1]);
			}
			Session::Remove('Notification');
		}
	}
}
?>