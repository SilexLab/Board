<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

// Falls eingeloggt, auf Startseite weiterleiten.	
if(isset($_COOKIE['sbb_loginHash']) || session::Read('userid')) 
	header("Location: index.php");
	
$Content = '{$:login}';

if(isset($_POST['Register'])) {
	$_SESSION['RegisterName'] = $_POST['Username'];
	$_SESSION['RegisterPass'] = $_POST['Password'];
	header("Location: ?page=Register");	
} elseif(isset($_POST['SubmitLogin'])) { 	// Formularauswerten
	if(isset($_POST['StayLoggedIn']))
		$AllwaysLogged = true;
	else
		$AllwaysLogged = false;

	$Login = new login($_POST['Username'], $_POST['Password'], $AllwaysLogged);
	$Content = login::GetMsg();
}
self::$TPL->Assign('Content', $Content);
?>