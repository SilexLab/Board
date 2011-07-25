<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class ForumPage extends Page {
	protected static function Load() {
		SBB::PageInfo()->Set('ID', 'Forum');		

		//crumb::Add('Forum', '?page=Forum');
		Template::Assign(array('Forums' => ForumList::ListForums()));
	}
}

?>