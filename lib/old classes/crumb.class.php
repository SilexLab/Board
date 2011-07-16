<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class crumb {
	private static $Crumb = array();
	
	public static function Add($Title, $Link) {
		self::$Crumb[] = array($Title, $Link);
	}
	
	/*public static function Remove($Num = 1) {
		$Crumb =& self::$Crumb[];
		for($i = sizeof($Crumb) - 1; $i >= sizeof($Crumb) - 1 - $Num; $i--) {
			unset($Crumb[$i]);
		}
	}*/
	
	public static function Parse() {
		$Crumb =& self::$Crumb;
		
		$Return = '';
		foreach($Crumb as $Value) {
			$Title = $Value[0];
			$Link = $Value[1];
			
			$Return .=
			'					<span class="Crust">'."\n".
			'						<a href="'.$Link.'" class="Crumb">'.$Title.'</a>'."\n".
			'						<span class="Arrow"><span></span></span>'."\n".
			'					</span>'."\n";
		}
		return $Return;
	}
}
?>