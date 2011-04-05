<?php
include_once('init.php');
$login = new login;

$login->DoLogout();

echo '<p>Sie sind jetz ausgeloggt.</p>';

echo '<p><a href="login.php">Einloggen</a></p>';
?>