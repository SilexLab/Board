<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

$GeneratingTime = microtime(true);

// Redirect to installation if not installed
if(!file_exists('lib/includes/config.inc.php'))
	header('Location: install.php');

// Define the Silex Board root directory
define('DIR_ROOT', dirname(__FILE__).'/');

include_once('lib/init.php');
echo "\n".'<br><span style="color: white;">Real Load: '.round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms</span>';
?>