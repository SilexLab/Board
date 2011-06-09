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
	$Var = $Lang->GetName();
	$Message .= '{lang=com.sbb.language.changed.1} <b>'.$Var.'</b>{lang=com.sbb.language.changed.2}';
	// TODO: Die Richtigen Funktionen benutzen! Das zeug wird eigentlich in die languageklasse geladen.
	$Message .= '<br><br>{lang=com.sbb.login.redirect}
				 <br>{lang=com.sbb.login.ifnotredirect}<a href="./">Link</a>';
	$Message .= '<script type="text/javascript">
					window.setTimeout("window.location.href=\'./\'",2000);
				</script>';
}

self::$TPL->Assign('Content', $Message);
?>