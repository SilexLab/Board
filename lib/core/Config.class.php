<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Config {
	protected static $Config = array(),
		$tplVariables = array();
	
	public function __construct() {
		if(!empty(self::$Config))
			return false;
		
		$O = SBB::DB()->query('SELECT * FROM `config`')->fetchAll(PDO::FETCH_OBJ);

		if(isset($O)) {
			foreach($O as $C) {
				$Value = ''; $Type = array();
				$this->FormatValue($C->ConfigValue, $C->ValueType, $C->ConfigNode, $Value, $Type);
				// TODO: for ACP include type
				self::$Config[$C->ConfigNode] = $Value;
				if($C->TemplateVariable)
					self::$tplVariables[$C->TemplateVariable] = $C->ConfigValue;
			}
		}
	}
	
	/**
	 * Return the value of the given node
	 * if the node is unknown return null
	 * @param  string $Node
	 * @return mixed
	 */
	public function Get($Node) {
		return isset(self::$Config[$Node]) ? self::$Config[$Node] : null;
	}

	/* TODO: Beatify and improve the code starting here, it works but it's ugly */

	/**
	 * Formates the value and give it the right type
	 * @param string    $rValue
	 * @param string    $rType
	 * @param reference $Value
	 * @param reference $Type
	 */
	private function FormatValue($rValue, $rType, $Node, &$Value, &$Type) {
		preg_match('/[a-zA-Z]+/', $rType, $mType);
		switch ($mType[0]) {
			case 'string':
				$Value = (string)$rValue;
				if(defined('ACP'))
					$Type = $this->ParseType($Type, $rType, true);
				break;
			case 'int':
				$Value = (int)$rValue;
				if(defined('ACP'))
					$Type = $this->ParseType($Type, $rType);
				break;
			case 'float':
				$Value = (float)$rValue;
				if(defined('ACP'))
					$Type = $this->ParseType($Type, $rType);
				break;
			case 'bool':
				if(in_array($rValue, array('true', '1')))
					$Value = true;
				else if(in_array($rValue, array('false', '0')))
					$Value = false;
				else
					throw new SystemException('The config node "'.$Node.'" is in the wrong format. Bool expected, the value is: "'.$Value.'"');
			default:
				throw new SystemException('The type ('.self::$Config[$Node]['Type'].') of the node "'.$Node.'" is not a valid type.');
		}
	}

	/**
	 * Parse length or range
	 * @param reference $Type
	 * @param string    $rType
	 */
	private function ParseType(&$Type, $rType, $OnlyLength = false) {
		if(!$OnlyLength && preg_match('/(\-{0,1}[0-9]+(\.[0-9]+){0,1}){0,1}\|(\-{0,1}[0-9]+(\.[0-9]+){0,1}){0,1}/', $rType, $Range)) {
			// Range
			$Range = $Range[0];
			$aR = explode('|', $Range);
			if(isset($aR[0]) && !empty($aR[0]) && isset($aR[1]) && !empty($aR[1])) {
				// Range
				if($aR[0] < $aR[1]) {
					$Type = array('Range' => array('Min' => (int)$aR[0], 'Max' => (int)$aR[1]));
				}
			} else if(isset($aR[0]) && !empty($aR[0])){ // Min
				$Type = array('Range' => array('Min' => (int)$aR[0]));
			} else { // Max
				$Type = array('Range' => array('Max' => (int)$aR[1]));
			}
		} else if(preg_match('/[0-9]+/', $rType, $Length)) {
			// Length
			$Type = array('Length' => $Length);
		}
	}
}
