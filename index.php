<?php
include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');

$parser = new messageParser;
$message = $parser->parse('[b]Hi nox[/b] (h)');

$tpl = new template('head', 'body', 'footer');
$tpl->Assign('message', $message);
$tpl->Assign(array('VariablenSindQL' => 'Variablen sind QL',
'Test2Var' => 'Eine Variable im Test2 Template'));

$tpl->Display();
?>