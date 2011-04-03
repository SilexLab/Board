<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

include_once('constants.inc.php');
include_once('functions.inc.php');

$language = new language();
$tpl = new template('head', 'register', 'footer');

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