<?php
/**
 * @author		SilexBoard Team
 *					Angus
 * @copyright	2011 SilexBoard
 */

class session {
	
	public static function read($sessionname) { // liest den inhalt einer Session aus, falls leer, gibt false zuruck
		return(isset($_SESSION[$sessionname]) ? $_SESSION[$sessionname] : false);
	}
	
	public static function set($sessionname,$value) { // setzt den Inhalt einer session
		if(($_SESSION[$sessionname] = $value) === true)
			return true;
		else
			return false;
	}
	
	public static function remove($sessionname) { // unsettet den inhalt einser session
		if(session_unset($sessionname))
			return true;
		else
			return false;	
	}
}