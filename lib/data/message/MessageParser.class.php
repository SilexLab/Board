<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		Revision: 1
 */

class MessageParser {
	public static function Parse($Message) {
		switch(strtolower(CFG_MARKUP)) {
			case 'silexcode':
				Autoloader::AddDir('data/message/silexcode/');
				SilexCode::Parse($Message);
				break;
			//case 'bbcode': // later maybe bbcode
		}
	}
}
?>