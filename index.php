<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// Sorry sir, what time is it?
$WhatTimeIsIt = microtime(true);

// Define the Silex Board root directory
define('DIR_ROOT', dirname(__file__).'/');

// Die in html
function html_die($msg, $bg = '#fff', $c = '#000') {
	return '<!DOCTYPE HTML><html><head><meta charset=utf-8><title>HE IS DEAD!</title><style type="text/css">body{font-family:sans-serif;font-size:18px;background:'.$bg.';color:'.$c.';text-align:center;padding:50px;}</style></head><body>'.$msg;
}

// Check for init file
if(!file_exists('lib/init.php'))
	die(html_die('<img src="images/yuno.jpg" alt="Y U NO"><br><b>Y U NO JUST INSTALL SILEX BOARD RIGHT?!</b>'));
require_once ('lib/init.php');

/* Development */
if(CFG_DEBUG) {
	echo '<!-- Freakin\' debugging stuff -->'."\n";
	// performance
	echo 'Generated in <strong>'.round(((microtime(true) - $WhatTimeIsIt) * 1000), 2).' ms</strong>.';

	// piwik template for statistics
	if(file_exists('../silexboard.org/piwik_template.php')) {
		echo "\n".'<!-- Who are you and why are you here? Let\'s see... -->'."\n";
		include('../silexboard.org/piwik_template.php');
	}
}
