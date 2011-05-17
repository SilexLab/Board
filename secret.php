<?php
include_once('init.php');

if (!login::logged_in()) {
    $tpl->Assign('Content', '<p>Sie sind nicht eingeloggt.</p>
						<p><a href="./?page=Login">Anmelden</a></p>');
}

if (login::logged_in()) {
	$var = '<br>'.$group['GroupName'];
    $tpl->Assign('Content', '<p>Gesch&uuml;tzter Bereich</p>
							<p><a href="./?page=Logout">Ausloggen</a></p>'.$var);
}

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
$tpl->Display();
?>