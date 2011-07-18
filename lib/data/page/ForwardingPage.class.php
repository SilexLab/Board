<?php 
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */
 
class ForwardingPage extends Page {
	protected static function Load() {	
		Template::Assign(array('Page' => 'Forwarding'));
	}
}
?> 