<?php
/**
 * @author     Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SystemException extends Exception {
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}
	
	// TODO: Extend to a printable exception
}
