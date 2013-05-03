<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Breadcrumb extends AbstractNav {
	private $Crumbs = [];

	public function __construct() {}

	/**
	 * Append a crumb
	 * @param string $Title
	 * @param string $Target
	 */
	public function Add($Name, $Link, $Target = false) {
		$this->Crumbs[] = ['name' => Language::Get($Name), 'link' => $Target];
	}

	public function Remove($Name) {
		// TODO: do this better
		for($i = 0; $i < sizeof($this->Crumbs); $i++) {
			if($this->Crumbs[$i]['name'] == $Name) {
				unset($this->Crumbs[$i]);
			}
		}
		$this->Repack();
	}

	public function AddMany($Array) {
		foreach($Array as $Crumb) {
			$this->Add($Crumb['title'], $Crumb['link']);
		}
	}

	public function GetList() {
		return $this->Crumbs;
	}
}
