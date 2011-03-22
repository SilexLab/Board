<?php
include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');

$parser = new messageParser;
$message = $parser->parse('[b]Hi nox[/b] (h)');

$tpl = new template('head', 'body', 'footer');
$tpl->Assign('message', $message);
$tpl->Display();
?>