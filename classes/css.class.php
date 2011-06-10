<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class css {
	private static $Default = 'Standard';
	
	public static function IncludeCSS() {
		// TODO: Benutzten Style aus der DB auslesen und Je nachdem den Ordner wechseln.
		$Style = self::$Default;
		
		$Styles = '';
		foreach(scandir(PATH_STYLE.$Style.'/') as $File) {
			if(is_file(PATH_STYLE.$Style.'/'.$File) && (strpos($File, '.css') !== false))
				$Styles .= '<link href="'.PATH_STYLE.$Style.'/'.$File.'" rel="stylesheet" type="text/css">'."\n";
		}
		return $Styles;
	}
}
?>