<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

if(isset($_COOKIE['sbb_LoginHash']) || session::Read('UserID')) {
	Login::DoLogout();
	$Lang = SBB::Language();
	$Content = $Lang->Get('com.sbb.logout.logged_out').'<br>
				<a href="./">'.$Lang->Get('com.sbb.logout.main_menu').'</a>';
} else {
	$Lang = SBB::Language();
	$Content = 	$Lang->Get('com.sbb.logout.never_logged_in').'<br>
				<a href="./?page=Login">'.$Lang->Get('com.sbb.login.login').'</a>';
}

Template::Assign(array('Content' => $Content));
?>