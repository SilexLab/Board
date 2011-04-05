<?php
include_once('init.php');

$login = new Login;
$language = new language;
$tpl = new template('head', 'profile', 'footer');

if($login->logged_in()) {
    $tpl->Assign(array());
}
if(isset($_POST['submit'])) {
	$sql = new mysqlQuery;
	$updates = array("Homepage" => $_POST['homepage'],
					"Signatur" => $_POST['signature']);
	$sql->Update("users", $updates, "ID = 1"); // ToDo: funktion um die UserID rauszufinden
}

$language->Assign($tpl);
$tpl->Display();
?>