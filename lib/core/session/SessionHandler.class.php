<?php
/**
 * @author     SilexBB
 * @copyright  2011 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// PHP 5.4 has its own SessionHandler class
abstract class SessionHandler {
	abstract public function close();
	abstract public function destroy($sessionid);
	abstract public function gc($maxlifetime);
	abstract public function open($save_path, $sessionid);
	abstract public function read($sessionid);
	abstract public function write($sessionid, $sessiondata);
}
?>