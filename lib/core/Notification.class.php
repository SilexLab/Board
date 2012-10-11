<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Notification {
	/**
	 * Notification type constants
	 */
	const
		INFO    = 0,
		SUCCESS = 1,
		WARNING = 2,
		ERROR   = 3,
		NEUTRAL = 4;

	/**
	 * CSS-Classes for notification types
	 */
	protected static
		$Classes = [
			'info',
			'success',
			'warning',
			'error',
			'neutral'
		];

	/**
	 * Contains the notifications
	 */
	protected static
		$Notifications = null;

	/**
	 * Create a new Notification
	 * @param string $Message
	 * @param int    $Type = 0
	 */
	public static function Show($Message, $Type = 0) {
		if(!isset(self::$Classes[$Type]))
			$Type = self::NEUTRAL;

		self::$Notifications[] = [
			'message' => $Message,
			'type'    => self::$Classes[$Type]
		];
	}

	/**
	 * Assign the notifications to the template
	 */
	public static function Assign() {
		SBB::Template()->Assign(['notifications' => self::$Notifications]);
	}
}
