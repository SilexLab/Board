<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

if(isset($_COOKIE['sbb_LoginHash']) || session::Read('UserID')) {
	login::DoLogout();
	$Content = '{lang=com.sbb.logout.logged_out} <br>
				<a href="./">{lang=com.sbb.logout.main_menu}</a>';
} else {
	$Content = '{lang=com.sbb.logout.never_logged_in} <br>
				<a href="./?page=Login">{lang=com.sbb.login.login}</a>';
}

self::$TPL->Assign('Content', $Content);
?>