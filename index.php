<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
 */

$GeneratingTime = microtime(true);
if(!file_exists('config.inc.php')) // Leitet zur Installation falls nicht installiert
	header('Location: install.php');

include_once('init.php');
?>