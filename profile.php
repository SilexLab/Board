<?php
include_once('init.php');

$login = new login;
$language = new language;
$tpl = new template('head', 'profile', 'footer');

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite',
'message' => ''));
if($login->logged_in()) {
    $tpl->Assign(array());
}
if(isset($_POST['submit'])) {
	$sql = new mysqlQuery;
	$updates = array("Homepage" => $_POST['homepage'],
					"Signatur" => $_POST['signature']);
	$sql->Update("users", $updates, "ID = 1"); // TODO: funktion um die UserID rauszufinden
}

$language->Assign($tpl);
$tpl->Display();
?>