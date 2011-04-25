<?php
include_once('init.php');

$language = new language();

if(session::read('userid'))
	header("Location: index.php");
	
if (isset($_POST['submit_login'])) { //wen abgesendet wurde dann
	$userid = login::check_user($_POST['username'], $_POST['password']); //user_check
	if ($userid) {
		login::DoLogin($userid); //wen alles stimmt wird engeloggt
		session::set('userid',$userid);
		session::set('username',$_POST['username']);
	} else {
		$tpl->Assign('Content', '<p>'.$language->Get('com.sbb.login.wrongdata').'</p>');
	}
}

if (!login::logged_in()) { //wen nicht eingeloggt ist wird loginfeld angezigt
	
	$tpl->Assign('Content', '<form method="post">
		<table>
			<tr>
				<td><label for="username">'.$language->Get('com.sbb.login.username').'</label></td>
				<td><input type="text" name="username" id="username" size="30" required /></td>
			</tr>
			<tr>
				<td><label for="password">'.$language->Get('com.sbb.login.password').'</label></td>
				<td><input type="password" name="password" id="password" size="30" required /></td>
			</tr>
		</table>
		<input type="submit" name="submit_login" value="'.$language->Get('com.sbb.form.submit').'" />
	</form>');
	
} else { //ansonsten ist eingeloggt
    $tpl->Assign('Content', '<p>'.$language->Get('com.sbb.login.redirect').'</p>
		<p>'.$language->Get('com.sbb.login.ifnotredirect').'<a href="secret.php">Link</a></p>');
	echo' <script type="text/javascript">
			window.setTimeout("window.location.href=\'secret.php\'",2000);
		</script>';
}

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
$tpl->Display();
?>