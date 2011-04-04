<?php
include_once('init.php');
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