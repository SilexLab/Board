<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */
// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);

// Include required files
require_once('config.inc.php');
require_once('constants.inc.php');
require_once('functions.inc.php');

// Sessions
session_start();

// Connect to MySQL-Database
mysql::Connect($CFG_Host, $CFG_User, $CFG_Password, $CFG_Database);

// default timezone (for date functions)
date_default_timezone_set('Europe/Berlin');

// variables
$tpl = new template('head', 'body', 'footer');
$tpl->Assign('Username', login::logged_in() ? 'Eingeloggt als '.login::GetUsername(session::read('userid')) : 'Nicht eingeloggt');
$tpl->Assign('LoginLogout',login::logged_in() ? '<a href="#">Inbox</a> <a href="logout.php">Logout</a>' : '<a href="login.php">Login</a> <a href="register.php">Register</a>');

// Breadcrumbstart
crumb::Add('{lang=com.sbb.crumbs.home}', './');

// Menu Parse
$tpl->Assign('Menu',menu::Parse());

if(basename($_SERVER['PHP_SELF']) == 'index.php'){
	switch($_GET['page'])
	{
		case '': $tpl->Assign('Menu',menu::Parse('Forum')); break;
		case 'User': $tpl->Assign('Menu',menu::Parse('Userlist')); break;

	}
}
// after 10 minutes you will automatically logged out

if(login::logged_in()) {
	mysql::Select('sessions', 'Time', 'Salt=\''.session_id().'\'');
	
	while($row = mysql::FetchArray()) {
		$lastTime = $row['Time'];
	}	
	
	$timeFuture = time() + 10 * 6;
	
	if($timeFuture - $lastTime > 600) {
		header("Location: logout.php");
	} else {
		$update = array("Time" => time());
		mysql::Update('sessions', $update, 'Salt=\''.session_id().'\'');
	}
}
?>