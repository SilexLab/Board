<?php
include_once('init.php');

if(isset($_COOKIE['sbb_loginHash']) || session::read('userid')) {
	login::DoLogout();
	$tpl->Assign('Content', '<p>Sie sind jetzt ausgeloggt.</p>
			<p><a href="./">Hauptmen&uuml;</a></p>');
}
else
{
	$tpl->Assign('Content', '<p>Sie waren niemals eingeloggt :o</p>
							<p><a href="login.php">Login</a></p>');
}

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
$tpl->Display();
?>