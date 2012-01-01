<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class DatabaseException extends Exception implements PrintableException {
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}
	
	public function __toString() {
		return parent::__toString();
	}
	
	public function Show() {
		echo 'Something is wrong with your Database, you should fix it ^.^<br>
The error says: ['.$this->code.'] '.$this->message; // lol should be a real error "page"
	}
}
?>