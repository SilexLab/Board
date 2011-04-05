<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

include_once('init.php');

$language = new language();
$tpl = new template('head', 'register', 'footer');

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
$tpl->Display(false, false);
?>