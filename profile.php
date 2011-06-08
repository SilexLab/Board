<?php
/* Was das für ne datei? */

include_once('init.php');

$language = new language;
$tpl = new template('head', 'profile', 'footer');

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite',
'message' => ''));
if(login::logged_in()) {
    $tpl->Assign(array());
}
if(isset($_POST['submit'])) {
	$updates = array("Homepage" => $_POST['homepage'],
					"Signatur" => $_POST['signature']);
	mysql::Update("users", $updates, "ID = 1"); // TODO: funktion um die UserID rauszufinden
}

$language->Assign($tpl);
$tpl->Display();
?>