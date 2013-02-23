<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SiteNav extends Nav {
	$Entries = [];
	
	public function __construct() {
	}

	protected function GetList() {
		$ActivePage = SBB::Page()->NavEntry();

		$NavList = array();
		$Entries = SBB::DB()->query('SELECT * FROM `nav` ORDER BY `Position`')->fetchAll(PDO::FETCH_OBJ);
		foreach($Entries as $Entry) {
			//$Permission = $Entry->Permission;
			$NavList[] = array(
				'name' => Language::Get($Entry->NavName),
				'link' => SBB::Page()->Link(preg_replace('/^p:(\w+)$/', '$1', $Entry->Target)),
				'active' => ($Entry->Target == 'p:'.$ActivePage) ? true : false
			);
		}

		SBB::Template()->Assign(['nav' => $NavList]);
	}
}
