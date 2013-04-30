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

// Fancy die
function die_html($msg, $bg = '#fff', $c = '#000') { die('<!DOCTYPE HTML><html><head><meta charset=utf-8><title>HE IS DEAD!</title><style type="text/css">body{font-family:sans-serif;font-size:18px;background:'.$bg.';color:'.$c.';text-align:center;padding:50px;}</style></head><body>'.$msg); }
function die_img($msg, $img, $bg = '#fff', $c = '#000') { die('<!DOCTYPE HTML><html><head><meta charset=utf-8><title>HE IS DEAD!</title><style type="text/css">body{font-family:sans-serif;font-size:18px;background:'.$bg.';color:'.$c.';text-align:center;padding:50px;}</style></head><body><img src="'.$img.'" alt="ERROR"><br><b>'.$msg.'</b>'); }

// Check for init file
if(!file_exists('lib/init.php'))
	die_img('Y U NO JUST INSTALL SILEX BOARD RIGHT?!', 'images/yuno.jpg');
require_once ('lib/init.php');

/* Development */
if(CFG_DEBUG) {
	echo '<!-- Freakin\' debugging stuff -->'."\n";
	// performance
	echo '<div class="w_size"><div class="w_content_h w_content_b" style="text-align: center; margin-top: -10px">Generated in <strong>'.round(((microtime(true) - $WhatTimeIsIt) * 1000), 2).' ms</strong>.</div></div>';

	// piwik template for statistics
	if(file_exists('../silexboard.org/piwik_template.php')) {
		echo "\n".'<!-- Who are you and why are you here? Let\'s see... -->'."\n";
		include('../silexboard.org/piwik_template.php');
	}
}
