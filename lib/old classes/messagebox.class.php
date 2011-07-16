<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 5
 */

class messagebox {
	private $Text = '';
	private $Type;
	
	private static $MessageBoxes = array();
	
	function __construct($Type = 0, $Text = NULL, $Mode = NULL, $Order = NULL) {
		switch($Type) {
			case MSG_BOX_TYPE_INFO:
				// Generates a blue box with an info icon
				$this->Type = 'messagebox info';
				break;
			case MSG_BOX_TYPE_ERROR:
				// Generates red box with error icon
				$this->Type = 'messagebox error';
				break;
			case MSG_BOX_TYPE_SUCCESS:
				// Generates green box with check icon
				$this->Type = 'messagebox success';
				break;
			case MSG_BOX_TYPE_WARNING:
				// Generates a orange kinda box with a warning icon inside.
				$this->Type = 'messagebox warning';
				break;
			default:
				// Generates a normal info box
				$this->Type = 'messagebox info';
		}
		
		// Shorten up the things here
		if(isset($Text)) {
			$this->Text = $Text;
			return $this->Display($Mode, $Order);
		}
	}
	
	public function SetText($Text) {
		$this->Text = $Text;
	}
	
	public function Display($Mode = 0, $Order = 0) {
		// MSG_BOX_MODE_NORMAL - Bindet die Box über dem Content ein
		// MSG_BOX_MODE_DIRECT - Gibt die Box als String für die direkte Verwendung im Code zurück
		$tpl = new template('messagebox');
		// Weist der Box die CSS Klasse aus $this->Type zu und setzt den Text
		$tpl->Assign(array('Type' => $this->Type, 'Text' => $this->Text));
		switch($Mode) {
			case MSG_BOX_MODE_NORMAL:
				if($Order == MSG_BOX_ORDER_UP)
					array_unshift(messagebox::$MessageBoxes, $tpl->Display(true));
				else
					messagebox::$MessageBoxes[] = $tpl->Display(true);
				break;
			case MSG_BOX_MODE_DIRECT:
				return $tpl->Display(true);
			default:
				messagebox::$MessageBoxes[] = $tpl->Display(true);
		}
	}
	
	public static function GetBoxes() {
		$Boxes = '';
		foreach(messagebox::$MessageBoxes as $Box) {
			$Boxes .= $Box."\n";
		}
		return $Boxes;
	}
}
?>