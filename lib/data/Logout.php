<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 5
 */
 
// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');
	
$Lang = SBB::Language();

if(isset($_COOKIE['sbb_LoginHash']) || session::Read('UserID')) {
	Login::DoLogout();
	$LogoutMessage 		= $Lang->Get('com.sbb.logout.logged_out');
	$LinkText 			= $Lang->Get('com.sbb.logout.main_menu');
	$Link 				= './';
} else {
	$LogoutMessage 		= $Lang->Get('com.sbb.logout.never_logged_in');
	$LinkText 			= $Lang->Get('com.sbb.login.login');
	$Link 				= './?page=Login';
}

Template::Assign(array('Page' => 'Logout', 'LogoutMessage' => $LogoutMessage, 'Link' => $Link, 'LinkText' => $LinkText));
?>