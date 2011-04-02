<?php
include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');
session_start();
$tpl = new template('head', 'body', 'footer');
$login = new Login;

echo 'Sie sind ';
if (!$login->logged_in()) {
    echo 'nicht ';
}
echo 'eingeloggt.<p />';

if (!$login->logged_in()) {
    echo '<p><a href="login.php">Anmelden</a></p>';
}



if ($login->logged_in()) {
    echo '<p>Geschützter Bereich</p>';

    echo '<p><a href="logout.php">Ausloggen</a></p>';
}
$tpl->Display();
?>