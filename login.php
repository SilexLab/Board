<?php
include_once('init.php');

$language = new language();
$tpl = new template('head', 'login', 'footer');

if (isset($_POST['submit_login'])) { //wen abgesendet wurde dann
	$userid = login::check_user($_POST['username'], $_POST['password']); //user_check
	if ($userid) {
		login::DoLogin($userid); //wen alles stimmt wird engeloggt
	} else {
		echo 'Ihre Anmeldedaten waren nicht korrekt!';
	}
}

if (!login::logged_in()) { //wen nicht eingeloggt ist wird loginfeld angezigt
	
	$tpl->Assign('content', '<form method="post">
		<table>
			<tr>
				<td><label for="username">'.$language->Get('com.sbb.login.username').'</label></td>
				<td><input type="text" name="username" id="username" size="30" required /></td>
			</tr>
			<tr>
				<td><label for="password">'.$language->Get('com.sbb.login.password').'</label></td>
				<td><input type="password" name="password" id="password" size="30" required /></td>
			</tr>
		</table>
		<input type="submit" name="submit_login" value="'.$language->Get('com.sbb.form.submit').'" />
	</form>');
	
} else { //ansonsten ist eingeloggt
    $tpl->Assign('content', "<p><a href=\"secret.php\">Testseite</a></p>
	<p><a href=\"logout.php\">Ausloggen</a></p>");
}
$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
$tpl->Display();
?>