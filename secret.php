<?php
include_once('init.php');
$login = new Login();
$tpl->Assign('Username',$login->GetUsername(session::read('userid')));

echo '<p>Sie sind '.(!login::logged_in() ? 'nicht' : '').' eingeloggt.</p>';

if (!login::logged_in()) {
    echo '<p><a href="login.php">Anmelden</a></p>';
}



if (login::logged_in()) {
    echo '<p>Gesch&uuml;tzter Bereich</p>';

    echo '<p><a href="logout.php">Ausloggen</a></p>';
}
?>