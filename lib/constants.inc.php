<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// System Constants
define('SBB_VERSION',  '0.1.0 DEV');

preg_match('/[a-zA-Z0-9]+\.php/', $_SERVER['PHP_SELF'], $match);
define('ROOT_URI', (!empty($_SERVER['HTTPS']) && 'on' == $_SERVER['HTTPS'] ? 'https://' : 'http://').
	$_SERVER['HTTP_HOST'].strstr($_SERVER['PHP_SELF'], $match[0], true)); unset($match);

// Directory Constants
define('DIR_TPL',      'templates/');
define('DIR_TPLC',     CFG_CACHE_DIR.'templates/');
define('DIR_SMILEY',   'images/smiley/');
define('DIR_LANGUAGE', 'lib/language/');
define('DIR_PAGE',     'lib/data/page/');
define('DIR_STYLE',    'styles/');
define('DIR_JS',       'javascripts/');


// Define "lib" directory constant
if(!defined('DIR_LIB'))
	define('DIR_LIB', dirname(__FILE__).'/');
?>