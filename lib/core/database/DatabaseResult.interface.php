<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

interface DatabaseResult {

	public function FetchArray();
	public function FetchArrays();
	public function FetchObject();
	public function FetchObjects();
	public function NumRows();

	public function GetMultiQueryResults();

	// You shall not use this method to get the result and read database entries!
	public function GetResult();
}
?>