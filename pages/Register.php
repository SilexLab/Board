<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx, Angus, Nut
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
//Falls eingeloggt, auf Startseite weiterleiten.	
if(session::read('userid')) 
	header("Location: index.php");

$content = '
					<form method="post">
						<table>
							<tr>
								<td><label for="username">{lang=com.sbb.register.username}</label></td>
								<td><input type="text" name="Username" id="Username" size="30" value="'.$_SESSION['RegisterName'].'" required /></td>
							</tr>
							<tr>
								<td><label for="password">{lang=com.sbb.register.password}</label></td>
								<td><input type="password" name="Password" id="Password" size="30" value="'.$_SESSION['RegisterPass'].'" required /></td>
							</tr>
							<tr>
								<td><label for="passwordrepeat">{lang=com.sbb.register.password.repeat}</label></td>
								<td><input type="password" name="Passwordrepeat" id="Passwordrepeat" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="email">{lang=com.sbb.register.email}</label></td>
								<td><input type="email" name="Email" id="Email" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="emailrepeat">{lang=com.sbb.register.email.repeat}</label></td>
								<td><input type="email" name="Emailrepeat" id="Emailrepeat" size="30" required /></td>
							</tr>
						</table>
						<input type="submit" name="Register" value="{lang=com.sbb.form.submit}" />
					</form>
';

if(isset($_POST['Register'])) {
	if(register::Check($_POST)) {
		user::Create($_POST['Username'], $_POST['Password'], $_POST['Email']);
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		$content .= '{lang=com.sbb.register.success}';
	}
	else
		session_unset($_SESSION['RegisterName']);
		session_unset($_SESSION['RegisterPass']);
		$content .= register::getError();		
}

self::$TPL->Assign('Content', $content);
?>