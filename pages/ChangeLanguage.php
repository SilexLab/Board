<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
$Language = $_POST['language'];

if(isset($Language)) {
	language::ChangeLang($Language);
	$Lang = new GetLang($Language.'.php');
	$Message .= 'Ihre Sprache wurde in '.$Lang->GetName().' geändert.'; // TODO: In die Language-Files schreiben
																		// TODO: Sprachstring benutzen!
																		// TODO: Die Richtigen Funktionen benutzen! Das zeug wird eigentlich in die languageklasse geladen.
}

self::$TPL->Assign('Content', $Message);
?>