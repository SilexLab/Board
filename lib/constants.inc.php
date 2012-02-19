<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// System Constants
define('SBB_VERSION',  'DEV');

// Directory Constants
define('DIR_TPL',      'templates/');
define('DIR_SMILEY',   'images/smiley/');
define('DIR_LANGUAGE', 'lib/language/');
define('DIR_PAGE',     'lib/data/page/');
define('DIR_STYLE',    'styles/');
define('DIR_JS',       'javascripts/');


// Define "lib" directory constant
if(!defined('DIR_LIB'))
	define('DIR_LIB', dirname(__FILE__).'/');
?>