<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 5
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

// Falls eingeloggt, auf Startseite weiterleiten.	
if(isset($_COOKIE['sbb_loginHash']) || session::Read('userid')) 
	header("Location: index.php");
	
$Content = '{$:login}';

switch($_POST['Register']) {
	case 1:
		$_SESSION['RegisterName'] = $_POST['Username'];
		$_SESSION['RegisterPass'] = $_POST['Password'];
		header("Location: ?page=Register");
		break;
	case 0:
		isset($_POST['StayLoggedIn']) ? $AllwaysLogged = true : $AllwaysLogged = false;
		$Login = new login($_POST['Username'], $_POST['Password'], $AllwaysLogged);
		$Content = login::GetMsg();
		break;
}

self::$TPL->Assign('Content', $Content);
?>