<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Nav extends Singleton {
	protected static $Instance;

	// Navigations
	protected $Site;
	protected $Sub;
	protected $User;
	
	// Assign the nav as vars to the template
	protected function __construct() {
		$this->Site = new SiteNav();
		$this->Sub = new SubNav();
		$this->User = new UserNav();




		// -- Old -- //
		// TODO: Move to SiteNav
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

	/**
	 * Get the template assignment
	 * @return  array
	 */
	protected function GetAssignment() {
		return [];
	}

	/**
	 * This should be called if the navigation processing is finished
	 */
	public function Finish() {
		SBB::Template()->Assign(['nav' => [
			'site' => $this->Site->GetAssignment(),
			'sub' => $this->Sub->GetAssignment(),
			'user' => $this->User->GetAssignment()
		]]);
	}

	/**
	 * Return the main (site) navigation object
	 * @return  SiteNav
	 */
	public function Site() {
		return $this->Site;
	}

	/**
	 * Return the sub page navigation object
	 * @return  SubNav
	 */
	public function Sub() {
		return $this->Sub;
	}

	/**
	 * Return the user navigation object
	 * @return  UserNav
	 */
	public function User() {
		return $this->User;
	}
}
