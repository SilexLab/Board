<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 2
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
$language = $_POST['language'];

if(isset($language)) {
	GetLang::changeLang($language);
	$lang = new GetLang($language.'.php');
	$message .= 'Ihre Sprache wurde in '.$lang->GetName().' geändert.'; //TO-DO: In die Language-Files schreiben
}

self::$TPL->Assign('Content', $message);
?>