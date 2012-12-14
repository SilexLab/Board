<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Breadcrumb {
	private static $Crumbs = array();

	/**
	 * Append a crumb
	 * @param string $Title
	 * @param string $Target
	 */
	public static function Add($Title, $Target) {
		self::$Crumbs[] = array('title' => Language::Get($Title), 'link' => $Target);
	}

	public static function AddMany($Array) {

		foreach($Array as $Crumb) {
			self::Add($Crumb['title'], $Crumb['link']);
		}

	}

	/**
	 * Send the breadcrumbs to the template
	 */
	public static function Assign() {
		SBB::Template()->Assign(['crumbs' => self::$Crumbs]);
	}
}
