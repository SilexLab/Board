<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);

// Include required files
require_once('config.inc.php');
require_once('constants.inc.php');
require_once('functions.inc.php');

// Global Variables
$gPage = array();
$gPage['Site'] = 'Home';

// Sessions
session_start();

// Connect to MySQL-Database
mysql::Connect($CFG_Host, $CFG_User, $CFG_Password, $CFG_Database);

// default timezone (for date functions)
date_default_timezone_set('Europe/Berlin');

// variables
$tpl = new template('case');

$tpl->Assign('Username', login::logged_in() ? 'Eingeloggt als '.login::GetUsername($_COOKIE['sbb_UserId']) : 'Nicht eingeloggt');
$tpl->Assign('LoginLogout',login::logged_in() ? '<a href="#">Inbox</a> <a href="logout.php">Logout</a>' : '<a href="login.php">Login</a> <a href="register.php">Register</a>');

// Breadcrumbstart
crumb::Add('{lang=com.sbb.crumbs.home}', './');

// Menu Parse
$tpl->Assign('Menu', menu::Parse());

/*if(basename($_SERVER['PHP_SELF']) == 'index.php'){
	switch($_GET['page'])
	{
		case '': $tpl->Assign('Menu',menu::Parse('Forum')); break;
		case 'User': $tpl->Assign('Menu',menu::Parse('Userlist')); break;

	}
}*/

$group = groups::getRights();

// after 10 minutes you will automatically logged out
login::autoLogout(); 


$language = new language();

$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
page::Initial($tpl);

$language->Assign($tpl);
$tpl->Display(false, true);
?>