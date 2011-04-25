<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx, Angus
 * @copyright	2011 SilexBoard
 */

include_once('init.php');

$language = new language();
$tpl = new template('head','register','footer');
$tpl->Assign('Username', login::logged_in() ? 'Eingeloggt als '.login::GetUsername(session::read('userid')) : 'Nicht eingeloggt');
$tpl->Assign('LoginLogout',login::logged_in() ? '<a href="#">Inbox</a> <a href="logout.php">Logout</a>' : '<a href="login.php">Login</a> or <a href="register.php">Regsiter</a>');

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite',
'message' => ''));
if(isset($_POST['submit'])) {
	if(register::Check($_POST)) {
		user::Create($_POST['username'], $_POST['password'], $_POST['email']);
		$tpl->Assign('message', '{lang=com.sbb.register.success}');
	}
	else
		$tpl->Assign('message', register::getError());
}

$language->Assign($tpl);
$tpl->Display();
?>