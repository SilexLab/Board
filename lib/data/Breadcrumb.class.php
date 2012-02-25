<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Breadcrumb {
	private static $Crumbs = array();

	/**
	 * Append a crumb
	 * @param string $Title
	 * @param string $Target
	 */
	public static function Add($Title, $Target) {
		self::$Crumbs[] = array('Title' => Language::Get($Title), 'Link' => $Target);
	}

	/**
	 * Send the breadcrumbs to the template
	 */
	public static function Assign() {
		$Crumbs = array();
		foreach (self::$Crumbs as $Crumb) {
			$Crumbs[] = array('Title' => Language::Get($Crumb['Title']), 'Link' => $Crumb['Link']);
		}
		SBB::Template()->Set(array('Crumbs' => $Crumbs));
	}
}
?>