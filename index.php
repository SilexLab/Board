<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

$GeneratingTime = microtime(true);

if(!file_exists('lib/config.inc.php'))
	die('Your config file is missing!');

// Define the Silex Board root directory
define('DIR_ROOT', dirname(__file__).'/');

require_once ('lib/init.php');
echo "\n".'<br><span style="color: white;">Real Load: '.round(((microtime(true) -
	$GeneratingTime) * 1000), 2).'ms</span>';
?>