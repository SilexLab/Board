<?php
/**
 * @author     SilexBB
 * @copyright  2011 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// Include config
require_once('config.inc.php');

// Include common constants and functions
require_once('constants.inc.php');
require_once('functions.inc.php');

// Register the autoloader
ini_set('unserialize_callback_func', 'spl_autoload_call');
require_once('Autoloader.class.php');
Autoloader::Register();

// Display Errors
if(defined('CFG_DEBUG') && CFG_DEBUG) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE | E_STRICT);
}

// TODO: Set this in the databaseconfig
date_default_timezone_set('Europe/Berlin');
?>