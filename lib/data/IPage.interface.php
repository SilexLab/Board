<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

interface IPage {
	/**
	 * Will called when the page is the current page
	 */
	public function Display(Page $P);
	
	/**
	 * Returns the callable link for this site
	 * e.g. ?page=Home
	 * @return string
	 */
	public function Link();

	/**
	 * Return the title of the current page
	 * @return string
	 */
	public function Title();
	
	/**
	 * Return the template file which belongs to the page
	 * @return string
	 */
	public function Template();

	/**
	 * Return additional information if available
	 * @param  string $Info
	 * @return mixed
	 */
	public function Info($Info);
}
