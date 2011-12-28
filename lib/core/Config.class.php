<?php
/**
 * @author     SilexBB
 * @copyright  2011 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Config {
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
}
?>