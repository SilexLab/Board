<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

$GT = microtime(true);

// Define the Silex Board root directory
define('DIR_ROOT', dirname(__file__).'/');

// Check for init file
if(!file_exists('lib/init.php'))
	die('Something is wrong with your installation');
require_once ('lib/init.php');

// Developement performance
echo '<span style="color: white; margin: -20px 0 0 10px; display: block; text-shadow: 0 0 3px #000; font-size: 10px;">
	Load: <strong>'.round(((microtime(true) - $GT) * 1000), 2).' ms</strong>
</span>';
?>