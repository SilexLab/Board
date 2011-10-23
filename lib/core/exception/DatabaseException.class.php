<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class DatabaseException extends Exception {
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}
	
	public function __toString() {
		return __CLASS__.': ['.$this->code.']: '.$this->message;
	}
}
?>