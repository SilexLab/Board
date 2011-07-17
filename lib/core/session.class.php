<?php
/**
 * @author 		Angus
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		DEV
 */

class Session {
	
	public static function Read($sessionname) { // liest den inhalt einer Session aus, falls leer, gibt false zuruck
		return(isset($_SESSION[$sessionname]) ? $_SESSION[$sessionname] : false);
	}
	
	public static function Set($sessionname,$value) { // setzt den Inhalt einer session
		if(($_SESSION[$sessionname] = $value) === true)
			return true;
		else
			return false;
	}
	
	public static function Remove($sessionname) { // unsettet den inhalt einser session
		if(session_unset($sessionname))
			return true;
		else
			return false;	
	}
}