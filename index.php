<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

include_once('init.php');

$parser = new messageParser();
$language = new language();
$tpl = new template('head', 'body', 'footer');

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));

$language->Assign($tpl);
$tpl->Display(false, false);
					// ^- Bugt rum wenn true :O
$a = 5;
$b = &$a;
$b++;
echo $a;
?>