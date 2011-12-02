<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class MessageBox {
	const
		NORMAL = 'info',
		SUCCESS = 'success',
		ERROR = 'error',
		WARNING = 'warning';
	private static $Boxes;
	
	public function __construct($Message, $Type = self::NORMAL) {
		if(!in_array($Type, array(self::NORMAL, self::SUCCESS, self::ERROR, self::WARNING)))
			$Type = self::NORMAL;
		
		self::$Boxes[] = array('Message' => $Message, 'Type' => $Type);
	}
	
	public static function Assign() {
		SBB::Template()->Assign(array('MessageBoxes' => self::$Boxes));
	}
}
?>