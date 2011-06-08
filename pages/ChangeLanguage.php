<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
if($_POST['language'])
{
	$lang = new GetLang($_POST['language'].'.php');
	$message = 'Ihre Sprache wurde in '.$lang->GetName().' geändert.';
}
self::$TPL->Assign('Content', $message);
?>