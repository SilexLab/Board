<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
//Falls eingeloggt, auf Startseite weiterleiten.	
if(isset($_COOKIE['sbb_loginHash']) || session::read('userid')) 
	header("Location: index.php");

//Wurde die Register direkt aufgerufen wird value leer sein
if(!isset($_SESSION['RegisterName']) || !isset($_SESSION['RegisterPass'])) {
	$sessionName = '';
	$sessionPass = '';
} else {
	$sessionName = $_SESSION['RegisterName'];
	$sessionPass = $_SESSION['RegisterPass'];
}

//Bearbeitung des Formulars
$message = '';
if(isset($_POST['Register'])) {
        if($_POST['Captcha'] != $_SESSION['Captcha']) {
		$message = '{lang=com.sbb.captcha.wrong}';
        }
	else if(register::Check($_POST)) {
		user::Create($_POST['Username'], $_POST['Password'], $_POST['Email']);
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		$message = '{lang=com.sbb.register.success}';
	}
	else {
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		$message = register::getError();
	}
}

//Füllt die Variablen im TPL
self::$TPL->Assign('RegisterName', $sessionName);
self::$TPL->Assign('RegisterPass', $sessionPass);
self::$TPL->Assign('RegisterMessage', $message);
self::$TPL->Assign('Content', '{$:register}');
?>