<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class Menu  implements Singleton {
	// TODO: get the page nodes from the page class
	private static $Instance = NULL;
	
	public static function GetInstance() {
		if(!self::$Instance)
			self::$Instance = new self;
		return self::$Instance;
	}
	
	private function __clone() {}
	
	// Assign the menu as vars to the template
	protected function __construct() {
		//$ActivePage = SBB::Page()->GetInfo('active');

		$MenuList = array();
		$Entries = SBB::DB()->Table('menu')->Select('*')->OrderBy('Position')->Execute()->FetchObjects();
		foreach($Entries as $Entry) {
			//$Permission = $Entry->Permission;

			$MenuList[] = array(
				'Name' => Language::Get($Entry->MenuName),
				//'Link' => SBB::Page()->GetLink($Entry->Target),
				'Active' => ($Entry->Target == $ActivePage) ? true : false
			);
		}

		SBB::Template()->Set(array('Menu' => $MenuList));
	}
}
?>