<?php
/**
 * @author		SilexBoard Team
 *					Nut
 * @copyright	2011 SilexBoard
 */

if(isset($_COOKIE['sbb_loginHash']) || session::read('userid')) {
	login::DoLogout();
	$content = '{lang=com.sbb.logout.logged_out} <br>
				<a href="./">{lang=com.sbb.logout.main_menu}</a>';
} else {
	$content = '{lang=com.sbb.logout.never_logged_in} <br>
				<a href="./?page=Login">{lang=com.sbb.login.login}</a>';
}

self::$TPL->Assign('Content', $content);
?>