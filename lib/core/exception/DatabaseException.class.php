<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class DatabaseException extends Exception implements IPrintableException {
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}
	
	public function Show() {
		// Sends the http header status code
		@header('HTTP/1.1 503 Service Unavailable');
		
		echo 'Something is wrong with your Database, you should fix it ^.^<br>
The error says: ['.$this->code.'] '.$this->message; // lol should be a real error message (page)
	}
}
