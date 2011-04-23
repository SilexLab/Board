<?php
include_once('init.php');

$login->DoLogout();

echo '<p>Sie sind jetzt ausgeloggt.</p>';

echo '<p><a href="login.php">Einloggen</a></p>';
?>