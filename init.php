<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 9
 */

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);

// Include required files
require_once('config.inc.php');
require_once('constants.inc.php');
require_once('functions.inc.php');

// Info Variables
page::$Info['Site'] = 'Home';

// Sessions
session_start();

// Connect to MySQL-Database
mysql::Connect($CFG_Host, $CFG_User, $CFG_Password, $CFG_Database);

$language = new language();

// default timezone (for date functions)
date_default_timezone_set('Europe/Berlin');

// template
$tpl = new template('case');

// Language Chooser
$Langs = $language->GetLanguages();
$DefaultLang = $language->Language;
foreach($Langs as $key => $val)
{
	if($DefaultLang == $key)
		$SelectLangs .= '<option selected="selected" value="'.$key.'">'.$val.'</option>';	
	else
		$SelectLangs .= '<option value="'.$key.'">'.$val.'</option>';					
}
$tpl->Assign('Languages',$SelectLangs);

// Breadcrumbstart
crumb::Add('{lang=com.sbb.crumbs.home}', './');

// Menu Parse
$tpl->Assign('Menu', menu::Parse());

// Get The Rights. Not useful at this moment
$group = groups::getRights();

// after 10 minutes you will automatically logged out
login::autoLogout(); 

/* MSG BOX TEST */
// Erstellt 2 MsgBoxes von und mit unterschiedlichen Types und Texten
$MsgBox = new messagebox(MSG_BOX_TYPE_NORMAL);
$MsgBox->SetText('Hiho Schweinebacke');
$MsgBox->Display();
$MsgBox = new messagebox(MSG_BOX_TYPE_ERROR);
$MsgBox->SetText('Das hier ist eine Fehlerbox, u know?');
$MsgBox->Display();
/* --- */

// Template Stuff
$tpl->Assign(array('Site' => 'Seitentitel',
'Slogan' => 'Slogan der Seite'));
page::Initial($tpl);

$tpl->Assign('MessageBox', messagebox::GetBoxes());
$language->Assign($tpl);
$tpl->Display(false, true);
?>