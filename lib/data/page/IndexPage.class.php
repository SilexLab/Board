<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
 */

class IndexPage extends Page {
	protected static function Load() {	
		// Übergeordnete Seite
		page::$Info['Site'] = 'Home';
	}
}
?>