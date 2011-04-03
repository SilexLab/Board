<?php
include_once('constants.inc.php');
include_once('config.inc.php');
include_once('functions.inc.php');
session_start();
$tpl = new template('head', 'body', 'footer');
$login = new Login;

if (isset($_POST['login'])) { //wen abgesendet wurde dann
    $userid = $login->check_user($_POST['username'], $_POST['userpass']); //user_check
    if ($userid) {
        $login->login($userid); //wen alles stimmt wird engeloggt
    } else {
        echo '<p>Ihre Anmeldedaten waren nicht korrekt!</p>';
    }
}

if (!$login->logged_in()) { //wen nicht eingeloggt ist wird loginfeld angezigt
    echo '
<form method="post" action="login.php">
<label>Benutzername:</label> <input name="username" type="text"><br />
<label>Passwort:</label> <input name="userpass" type="password" id="userpass"><br />
<input name="login" type="submit" id="login" value="Einloggen">
</form>
';
} else { //ansonsten ist eingeloggt
    echo '<p><a href="secret.php">Testseite</a></p>';
    echo '<p><a href="logout.php">Ausloggen</a></p>';
}
$tpl->Display();
?>