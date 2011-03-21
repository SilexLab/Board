<?php
include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');

$mysql = new mysql($CFG_Host, $CFG_User, $CFG_Password, $CFG_Database);
$test = $mysql->DoQuery('SELECT * FROM itschi_posts');
echo $test[1]->post_id;

$tpl = new template('head', 'body', 'footer');
$tpl->Display();
?>