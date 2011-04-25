<?php
include_once('init.php');

if (!login::logged_in()) {
    $tpl->Assign('Content', '<p>Sie sind nicht eingeloggt.</p>
						<p><a href="login.php">Anmelden</a></p>');
}

if (login::logged_in()) {
    $tpl->Assign('Content', '<p>Gesch&uuml;tzter Bereich</p>
							<p><a href="logout.php">Ausloggen</a></p>');
}

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
$tpl->Display();
?>