<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
// Falls eingeloggt, auf Startseite weiterleiten.	
if(isset($_COOKIE['sbb_loginHash']) || session::Read('userid')) 
	header("Location: index.php");

// Wurde die Register direkt aufgerufen wird value leer sein
if(!isset($_SESSION['RegisterName']) || !isset($_SESSION['RegisterPass'])) {
	$SessionName = '';
	$SessionPass = '';
} else {
	$SessionName = $_SESSION['RegisterName'];
	$SessionPass = $_SESSION['RegisterPass'];
}

// Bearbeitung des Formulars
$Message = '';
if(isset($_POST['Register'])) {
	// Captcha funktioniert nicht, also nicht checken.
	/*if($_POST['Captcha'] != $_SESSION['Captcha']) {
		$message = '{lang=com.sbb.captcha.wrong}';
	}
	else*/ if(register::Check($_POST)) {
		user::Create($_POST['Username'], $_POST['Password'], $_POST['Email']);
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		
		user::Email('Subject', 'hier kommt ein text', user::GetUserID($_POST['Username']));
		$Message = '{lang=com.sbb.register.success}';
	}
	else {
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		$Message = register::getError();
	}
}

// Füllt die Variablen im TPL
self::$TPL->Assign('RegisterName', $SessionName);
self::$TPL->Assign('RegisterPass', $SessionPass);
self::$TPL->Assign('RegisterMessage', $Message);
self::$TPL->Assign('Content', '{$:register}');
?>