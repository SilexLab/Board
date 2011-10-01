<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Menu {
	private static $ReservedLinks = array(
		'menu.home' => './',
		'menu.forum' => '?page=Board',
		'menu.userlist' => '?page=User'
	);
	
	public static function Render() {
		$Active = SBB::Page()->GetInfo('Menu');
		if(isset(self::$ReservedLinks['menu.'.strtolower($Active)]))
			$Active = 'menu.'.strtolower($Active);
		
		$MenuList = array();
		$Entries = SBB::SQL()->GetObjects()->Select('menu', '*', NULL, 'Position');
		foreach($Entries as $Row) {
			if(isset(self::$ReservedLinks[$Row->Target])) {
				$MenuList[] = array('Link' => self::$ReservedLinks[$Row->Target],
									'Name' => Language::Get($Row->MenuName),
									'Active' => $Active == $Row->Target ? true : false);
			} else {
				$Target = str_replace('?page=', '', $Row-Target);
				$Target = strpos($Target, '&') !== false ? strstr($Target, '&', true) : $Target;
				$MenuList[] = array('Link' => $Row->Target,
									'Name' => Language::Get($Row->MenuName),
									'Active' => $Active == $Target ? true : false);
			}
		}
		SBB::Template()->Assign(array('Menu' => $MenuList));
	}
}
?>