<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class Config {
	
	public static function Parse() {
		MySQL::Select('config');
		$Objects = MySQL::GetObjects();
		foreach($Objects as $Obj) {
			Template::Assign(array($Obj->ConfigName => $Obj->ConfigValue));
		}
	}

}