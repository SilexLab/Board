<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

include_once('init.php');

$language = new language();
$tpl = new template('head', 'body', 'footer');
page::Initial($tpl);

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));

$language->Assign($tpl);
$tpl->Display(false, true);
?>