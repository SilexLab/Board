<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Config implements ConfigInterface {
	public static function CreateConstants() {
		$Objects = SBB::SQL()->GetObjects()->Select('config', 'ConfigVariable, ConfigValue', 'Type = \'CONST\'');
		if(isset($Objects)) {
			foreach($Objects as $Config) {
				define('CFG_'.strtoupper($Config->ConfigVariable), $Config->ConfigValue);
			}
		}
	}
	
	
	
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