<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
// Falls eingeloggt, auf Startseite weiterleiten.	
if(isset($_COOKIE['sbb_loginHash']) || Session::Read('userid')) 
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
	$Lang = SBB::Language();
	// Captcha funktioniert nicht, also nicht checken.
	/*if($_POST['Captcha'] != $_SESSION['Captcha']) {
		$message = '{lang=com.sbb.captcha.wrong}';
	}
	else*/ if(Register::Check($_POST)) {
		User::Create($_POST['Username'], $_POST['Password'], $_POST['Email']);
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		
		User::Email('Subject', 'hier kommt ein text', User::GetUserID($_POST['Username']));
		$Message = $Lang->Get('com.sbb.register.success');
	}
	else {
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		$Message = Register::getError();
	}
}

// Füllt die Variablen im TPL
Template::Assign(array('RegisterName' => $SessionName, 'RegisterPass' => $SessionPass, 'RegisterMessage' => $Message, 'Page' => 'Register'));
?>