<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Any errors? */

// Check if the request came from index.php
if(!defined('DIR_ROOT'))
	header('location: ../');

// Check for config file
if(!file_exists('lib/config.inc.php'))
	die(html_die('<img src="images/yuno.jpg" alt="Y U NO"><br><b>Y U NO HAVE A CONFIG FILE?!</b>'));

// Include config file
require_once('config.inc.php');
if(!defined('CFG'))
	die(html_die('<img src="images/OhCrap.jpg" alt "OMG"><br><b>WHAT KIND OF CONFIG FILE IS THIS?</b>', '#000', '#fff'));


/* Bootstramp Silex Board \o/ */

// Display Errors
if(defined('CFG_DEBUG') && CFG_DEBUG) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE | E_STRICT);
}

// Include common constants and functions
require_once('constants.inc.php');
require_once('functions.inc.php');

// TODO: Read from database config / user preferences
date_default_timezone_set('Europe/Berlin');

// Register the autoloader
ini_set('unserialize_callback_func', 'spl_autoload_call');
require_once('Autoloader.class.php');
Autoloader::Register();

// Define custom handler
set_exception_handler(array('SBB', 'ExceptionHandler'));

// Set the custom session save handler and start sessions
Session::Start();

// Initial and "start" Silex Board
SBB::Initial();
