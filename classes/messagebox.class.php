<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

class messagebox {
	private $Text = '';
	private $Type;
	
	private static $MessageBoxes = array();
	
	function __construct($Type = 0, $Text = NULL, $Mode = NULL, $Order = NULL) {
		switch($Type) {
			case MSG_BOX_TYPE_NORMAL:
				// Erzeuge blaue Box mit Info-Icon
				$this->Type = 'MsgBoxNormal';
				break;
			case MSG_BOX_TYPE_ERROR:
				// Erzeuge rote Box mit Error-Icon
				$this->Type = 'MsgBoxError';
				break;
			case MSG_BOX_TYPE_SUCCESS:
				// Erzeuge grüne Box mit Haken-Icon (Kein Hakenkreuz)
				$this->Type = 'MsgBoxSuccess';
				break;
			default:
				// Erzeuge normale Box
				$this->Type = 'MsgBoxNormal';
		}
		
		// Shorten up the thinks here
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