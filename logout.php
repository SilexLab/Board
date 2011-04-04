<?php
include_once('init.php');
$tpl = new template('head', 'body', 'footer');
$login = new Login;

echo '<p>Sie sind ';
if (!$login->logged_in()) {
    echo 'nicht ';
}
echo 'eingeloggt.</p>';

$login->DoLogout();

echo '<p><a href="login.php">Einloggen</a></p>';
$tpl->Display();
?>