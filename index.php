<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');

$parser = new messageParser();
$language = new language();
$tpl = new template('head', 'body', 'footer');

$message = $parser->parse('[b]Hi Nox[/b] (h)');
$tpl->Assign('message', $message);
//$tpl->Assign('Site', 'Seitentitel');
$tpl->Assign(array('VariablenSindQL' => 'Variablen sind QL',
'Test2Var' => 'Eine Variable im Test2 Template'));

$language->Assign($tpl);
$tpl->Display(false, false);
?>