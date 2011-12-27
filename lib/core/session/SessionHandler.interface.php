<?php
/**
 * @author     SilexBB
 * @copyright  2011 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

interface SessionHandler {
	/**
	 * Initial the sessions and set the handler
	 */
	public function __construct();
	
	/**
	 * Handler functions
	 */
	public function Open($Path, $Name);
	public function Close();
	public function Read($SessionID);
	public function Write($SessionID, $Data);
	public function Destroy($SessionID);
	public function GC($MaxLife);
}
?>