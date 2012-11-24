<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Menu implements ISingleton {
	private static $Instance = NULL;
	
	/**
	 * Return the Instance of the Menu class
	 * @return	Menu
	 */
	public static function GetInstance() {
		if(!self::$Instance)
			self::$Instance = new self;
		return self::$Instance;
	}
	
	private function __clone() {}
	
	// Assign the menu as vars to the template
	protected function __construct() {
		$ActivePage = SBB::Page()->MenuEntry();

		$MenuList = array();
		$Entries = SBB::DB()->query('SELECT * FROM `menu` ORDER BY `Position`')->fetchAll(PDO::FETCH_OBJ);
		foreach($Entries as $Entry) {
			//$Permission = $Entry->Permission;
			$MenuList[] = array(
				'Name' => Language::Get($Entry->MenuName),
				'Link' => SBB::Page()->Link(preg_replace('/^p:(\w+)$/', '$1', $Entry->Target)),
				'Active' => ($Entry->Target == 'p:'.$ActivePage) ? true : false
			);
		}

		SBB::Template()->Assign(['Menu' => $MenuList]);
	}
}
