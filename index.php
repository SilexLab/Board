<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		Revision: 4
 */

$GeneratingTime = microtime(true);
if(!file_exists('lib/includes/config.inc.php')) // Leitet zur Installation falls nicht installiert
	header('Location: install.php');

include_once('lib/init.php');
echo "\n".'<br>Real Load: '.round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms';
?>