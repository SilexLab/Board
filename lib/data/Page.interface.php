<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

interface PageData {
	/**
	 * Returns the callable link for this site
	 * e.g. ?page=Home
	 * @return string
	 */
	public static function Link();

	/**
	 * Returns the identifier node for this site
	 * @return string
	 */
	public static function Node();
}
?>