<?php
include('lib/config.inc.php');
date_default_timezone_set('Europe/Berlin');

$DB = new PDO('mysql:dbname='.CFG_DB_DATABASE.';host='.CFG_DB_HOST./*(!empty(CFG_DB_PORT) ? ';port='.CFG_DB_PORT : '').*/';charset=utf8', CFG_DB_USER, CFG_DB_PASSWORD);

header('Content-Type: text/plain; charset=utf-8');
$DB->query(file_get_contents('Draft/Database.sql'));
echo 'Database updated to '.date('d.m.Y H:i:s', filemtime('Draft/Database.sql')).'.';
?>