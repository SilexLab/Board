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
	
	public static function CreateVariables() {
		$Objects = SBB::SQL()->GetObjects()->Select('config', 'ConfigVariable, ConfigValue', 'Type = \'VAR\'');
		
		$Variables = array();
		if(isset($Objects)) {
			foreach($Objects as $Variable) {
				$Variables[$Variable->ConfigVariable] = $Variable->ConfigValue;
			}
		}
		
		SBB::Template()->Assign($Variables);
	}
}