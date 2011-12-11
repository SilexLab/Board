<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Config implements ConfigInterface {
	private static $Config = array(),
		$tplVariables = array();
	
	public function __construct() {
		if(!empty(self::$Config))
			return false;
		
		$O = SBB::SQL()->Table('config')->Select(array('ConfigNode', 'ConfigValue', 'TemplateVariable'))->Execute()->FetchObjects();
		if(isset($O)) {
			foreach($O as $C) {
				self::$Config[$C->ConfigNode] = $C->ConfigValue;
				if($C->TemplateVariable)
					self::$tplVariables[$C->TemplateVariable] = $C->ConfigValue;
			}
		}
	}
	
	public function Get($Node) {
		return isset(self::$Config[$Node]) ? self::$Config[$Node] : $Node;
	}
	
	public static function GetTemplateVariables() {
		return self::$tplVariables;
	}
}