<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 * @version		DEV
 */

class PageInfo {
	private $Info;
	
	function __construct() {
		$this->Info = array(
			'Site' => 'Home',
			'ID' => 'Home' // ID-> Used for the active menutab (default: Home) (Parent Site)
		);
	}
	
	public function Set($Info, $Value) {
		$this->Info[$Info] = $Value;
	}
	
	public function Get($Info) {
		return $this->Info[$Info];
	}
}
?>