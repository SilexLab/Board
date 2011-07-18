<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class HomePage extends Page {
	protected static function Load() {	
		// Site Info
		SBB::PageInfo()->Set('Site', 'Home');
		SBB::PageInfo()->Set('ID', 'Home');
	}
}
?>