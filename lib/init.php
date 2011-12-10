<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

// PHP Initial
ini_set('display_errors', 1);
ini_set('unserialize_callback_func', 'spl_autoload_call');
date_default_timezone_set('Europe/Berlin');
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);
session_start();

// Define "lib" directory constant
if(!defined('DIR_LIB'))
	define('DIR_LIB', dirname(__FILE__).'/');

// Include required files
require_once('includes/config.inc.php');
require_once('includes/constants.inc.php');
require_once('core/SBB.class.php');

SBB::Load();

if(isset($_COOKIE['sbb_LoginHash']) && Session::Read('UserID') == false) {
	SBB::SQL()->Select('session', 'UserID', 'LoginHash = \''.mysql_escape_string($_COOKIE['sbb_LoginHash']).'\'');
	if(SBB::SQL()->RowExists('session', 'LoginHash = \''.mysql_escape_string($_COOKIE['sbb_LoginHash']).'\'')) {
		$row = SBB::SQL()->FetchArray();
		User::Login($row['UserID'], true);
	}
}

if(Session::Read('UserID') != false) {
	SBB::SQL()->Update('session', array('LastActivityTime' => time()), 'UserID = \''.Session::Read('UserID').'\'');
}
SBB::SQL()->Delete('session', '\''.(time()-60*20).'\' > LastActivityTime AND LoginHash IS NULL');

if(Session::Read('UserID') != false) {
	SBB::SQL()->Select('session', 'ID', 'UserID = \''.Session::Read('UserID').'\'');
	$row = SBB::SQL()->FetchArray();
	if(!$row['ID']) {
		$_SESSION = array();
		session_destroy();
	}
}





/*
// Initial Classes
Autoloader::Register();
MySQL::Connect(CFG_DB_HOST, CFG_DB_USER, CFG_DB_PASSWORD, CFG_DB_DATABASE); // TODO: UPDATE TO SQL-CLASS
Template::Initial();
SBB::Load(); // Initial Silex Board Core

// Post Initial -> Catching Infos
SBB::Language()->Assign();
Template::Assign(array(
	'Site' => 'Seitenname',
	'DIR_STYLE' => DIR_STYLE,
	'DIR_JS' => DIR_JS,
	'Load' => '~Load: '.round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms')
);

// Compile
Template::Display('case.tpl');
*/

// Old Initial:
/*
// Initial
date_default_timezone_set('Europe/Berlin');	// default timezone (for date functions)
session_start();	// Start Session

mysql::Connect($CFG_Host, $CFG_User, $CFG_Password, $CFG_Database);	// Connect to MySQL-Database
user::Initial();	// Initial Usermanagement
page::$Info['Site'] = 'Home';	// Info Variables
crumb::Add('{lang=com.sbb.crumbs.home}', './');	// Breadcrumbstart
login::AutoLogout();			// after 10 minutes you will automatically logged out

$Group = groups::GetRights();	// Get The Rights. Not useful at this moment
$language = new language();		// Load language management
$tpl = new template('case');	// Load template management
*/

/*// Language Chooser
$Langs = $language->GetLanguages();
$DefaultLang = $language->Language;
foreach($Langs as $key => $val)
{
	if($DefaultLang == $key)
		$SelectLangs .= '<option selected="selected" value="'.$key.'">'.$val.'</option>';	
	else
		$SelectLangs .= '<option value="'.$key.'">'.$val.'</option>';					
}
$tpl->Assign('Languages',$SelectLangs);*/

/*
new messagebox(MSG_BOX_TYPE_NORMAL, 'Test');
// Template Stuff
$tpl->Assign(array(
	'Site'			=> 'Seitentitel',
	'Slogan'		=> 'Slogan der Seite',
	'Menu'			=> menu::Parse(),
	'MessageBox'	=> messagebox::GetBoxes(),
	'CSSStyles'		=> style::IncludeCSS(),
	'Javascripts'	=> style::IncludeJS()
));
page::Initial($tpl);
$language->Assign($tpl);
$tpl->Assign('SiteLoad', round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms'); // Isn't optimal here
$tpl->Display(false, true);
*/
?>