<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Any errors? */

// Check if the request came from index.php
if(!defined('DIR_ROOT'))
	header('location: ../');

// Check for config file
if(!file_exists('lib/config.inc.php'))
	die_img('Y U NO HAVE A CONFIG FILE?!', 'images/yuno.jpg');

// Include config file
require_once('config.inc.php');
if(!defined('CFG'))
	die_img('WHAT KIND OF CONFIG FILE IS THIS?', 'images/OhCrap.jpg', '#000', '#fff');


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
