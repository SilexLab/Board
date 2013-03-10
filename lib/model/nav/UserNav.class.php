<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserNav extends Nav {
	protected $Entries = [];
	protected $Active;

	public function __construct() {
		// TODO: Get the one wich is active
		//$this->Active = ???
	}

	public function Add($Name, $Link, $Target = false) {
		$this->Entries[] = [
			'name' => $Name,
			'link' => $Link,
			'active' => $Target ? $Target == $this->Active : false
		];
	}

	public function Remove($Name) {
		// TODO: do this better
		for($i = 0; $i < sizeof($this->Entries); $i++) {
			if($this->Entries[$i]['name'] == $Name) {
				unset($this->Entries[$i]);
			}
		}
		$this->Repack();
	}

	protected function GetList() {
		return $this->Entries;
	}

	private function Repack() {
		$Repack = [];
		foreach($this->Entries as $Entry) {
			$Repack[] = $Entry;
		}
		$this->Entries = $Repack;
	}
}
