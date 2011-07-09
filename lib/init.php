<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 16
 */

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);

// Include required files
require_once('Includes/config.inc.php');
require_once('Includes/constants.inc.php');
require_once('Includes/functions.inc.php');

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
?>