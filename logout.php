<?php
include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');
session_start();
$tpl = new template('head', 'body', 'footer');
$login = new Login;

echo '<p>Sie sind ';
if (!$login->logged_in()) {
    echo 'nicht ';
}
echo 'eingeloggt.</p>';

$login->logout();

echo '<p>Sie sind ';
if (!$login->logged_in()) {
    echo 'nicht ';
}
echo 'eingeloggt.</p>';

echo '<p><a href="login.php">Einloggen</a></p>';
$tpl->Display();
?>