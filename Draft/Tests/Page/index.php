<?php
require_once('Page.class.php');
$P = new Page('Home');


echo $P->Link('Home');
echo $P->Link();
echo $P->Link('Blub');