<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Config {
	protected static $Config = array(),
		$tplVariables = array();
	
	public function __construct() {
		if(!empty(self::$Config))
			return false;
		
		$O = SBB::DB()->Table('config')->Select(array('ConfigNode', 'ConfigValue', 'TemplateVariable'))->Execute()->FetchObjects();
		if(isset($O)) {
			foreach($O as $C) {
				self::$Config[$C->ConfigNode] = $C->ConfigValue;
				if($C->TemplateVariable)
					self::$tplVariables[$C->TemplateVariable] = $C->ConfigValue;
			}
		}
		
		// Assign template variables to Template
		if(self::$tplVariables)
			SBB::Template()->Set(self::$tplVariables);
	}
	
	public function Get($Node) {
		return isset(self::$Config[$Node]) ? self::$Config[$Node] : $Node;
	}
}
?>