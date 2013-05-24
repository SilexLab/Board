<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
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

		// Login
		if(HtmlPost::Get('login') !== false) {
			// Check for correct submission, else ignore
			if(HtmlPost::Get('user') !== false && HtmlPost::Get('password') !== false) {
				$User = UserUtil::GetUserByName(HtmlPost::Get('user'));

				// Check password
				if($User !== null && $User->CheckPassword(HtmlPost::Get('password'))) {
					$User->Login();
				}
				// TODO: Error handling with notifications
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
