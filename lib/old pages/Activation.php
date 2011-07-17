<?php
/**
 * @author 		L00P
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 * @todo		Make Error Message's | IMPORTANT
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

if(isset($_GET['key'])) {
	if(mysql::Count('users', '*', "key = $key") == 1) {
		$Updates = array('Activated' => 1);
		mysql::Update('users', $Updates, "key = $key");
	}
} else {
	echo 'No Key!';
}
?>