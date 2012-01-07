<?php
/**
 * Session Test
 */

include('SessionHandler.class.php');

$Output = '';

$DB = new MySQLi('localhost', 'root', '', 'test');
//$DB->query('INSERT INTO `user` (`Username`, `Password`) VALUES (\'User\', \''.md5('1337').'\');');

$SessionHandler = new SessionHandler($DB);

session_set_cookie_params(1 * 24 * 60 * 60, NULL, NULL, NULL, true); // 1 Day
session_name ('SBB_SessionTest');
session_start();

// Check Login
$UserID = 0;
$DoLogin = false;
$Token = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['Login'])) {
		if(isset($_SESSION['UserID']) && $_SESSION['UserID'] > 0) {
			unset($_SESSION['UserID']);
			session_destroy();
			$Output = 'Augeloggt!';
		} else {
			$User = $_POST['Username'];
			$Password = $_POST['Password'];
			if($User == '')
				$Output = 'Kein Username angegeben';
			else if($Password == '')
				$Output = 'Kein Passwort angegeben';
			else {
				$User = $DB->real_escape_string($User);
				$PwHash = md5($Password);
				
				$Result = $DB->query('SELECT * FROM `user` WHERE `Username` = \''.$User.'\' AND `Password` = \''.$PwHash.'\' LIMIT 1;');
				if(!$Result->num_rows)
					$Output = 'Falscher Benutzername oder falsches Passwort';
				else {
					$UserID = $Result->fetch_object()->ID;
					$Token = sha1(md5(crypt($UserID).microtime()));
					$Output = 'Zugangsdaten richtig';
					$DoLogin = true;
				}
				$Result->close();
			}
		}
	}
}

// Do login
if($DoLogin) {
	$_SESSION['UserID'] = $UserID;
	$_SESSION['Token'] = $Token;
}

// Is logged in?
if(isset($_SESSION['UserID']) && $_SESSION['UserID'] > 0) {
	// Logged in
	$Output .= "\n\n".'Eingeloggt!';
} else {
	$_SESSION['Dummy'] = 'Gast';
}

$Output .= "\n\n".'Session['.session_id().']: '.print_r($_SESSION, true)."\n";
//$DB->close();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Session Test</title>
</head>

<body>
<form method="post">
	<input type="text" placeholder="Name" name="Username"> <input type="password" placeholder="Password" name="Password"> <input type="submit" name="Login" value="Login / Logout">
</form>
Debug:
<pre>
<?php echo $Output; ?>
</pre>
</body>
</html>