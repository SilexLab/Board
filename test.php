<?php
date_default_timezone_set('Europe/Berlin');

$Day = 86400;
$Current = time() - mktime(0, 0, 0, date('n'), date('j'), date('Y'));
echo $Current / $Day;
?>