<?php
include_once('init.php');

if(session::read('userid')) {
	login::DoLogout();
	session::remove('userid');
	session::remove('username');
	echo '<p>Sie sind jetzt ausgeloggt.</p>';
	
	echo '<p><a href="login.php">Einloggen</a></p>';
}
else
{
	echo('Sie waren niemals eingeloggt :o');
}
echo('<br /><a href="./">Hauptmen&uuml;</a>');
?>