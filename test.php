<?php
include('lib/functions.inc.php');
echo '<pre>';
echo getcwd()."\n";
print_r(scandirr('lib'));
echo '</pre>';
?>