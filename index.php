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
$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));

$language->Assign($tpl);
$tpl->Display(false, false);
					// ^- Bugt rum wenn true :O
?>