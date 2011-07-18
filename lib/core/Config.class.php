<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class Config {
	public static function Get() {
		MySQL::Select('config');
		$Objects = MySQL::GetObjects();
		foreach($Objects as $Obj) {
			// When a Config has a "CFG_"-prefix, Create a constant
			if(strtoupper(substr($Obj->ConfigName, 0, 4)) == 'CFG_')
				SBB::CreateConstant(substr($Obj->ConfigName, 4), $Obj->ConfigValue);
			else
				Template::Assign(array($Obj->ConfigName => $Obj->ConfigValue));
		}
	}
}