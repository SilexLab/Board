<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class ErrorPage extends Page {
	protected static function Load() {
		SBB::PageInfo()->Set('Site', 'Error');
		SBB::PageInfo()->Set('ID', 'Home');
		
		$Type = isset($_GET['type']) ? $_GET['type'] : 404;
		Template::Assign(array('Page' => 'Error', 'ErrorType' => $Type));
	}
}
?>