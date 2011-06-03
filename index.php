<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

if(!file_exists('config.inc.php')) // Leitet zur Installation falls nicht installiert
	header('Location: install.php');

include_once('init.php');

$language = new language();


$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
page::Initial($tpl);


$language->Assign($tpl);
$tpl->Display(false, true);
?>