<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Nav {
	// Navigations
	protected $Site;
	protected $Sub;
	protected $User;
	
	public function __construct() {
		$this->Site = new SiteNav();
		$this->Sub = new SubNav();
		$this->User = new UserNav();
	}

	/* Abstract stuff */

	/**
	 * Get the template list
	 * @return  array
	 */
	//abstract protected function GetList();
	//abstract public function Add($Name, $Link, $Target = false);
	//abstract public function Remove($Name);

	/* --- */

	/**
	 * This should be called if the navigation processing is finished
	 * and before the templates compile
	 */
	public function Finish() {
		SBB::Template()->Assign(['nav' => [
			'site' => $this->Site->GetList()
			//'sub' => $this->Sub->GetList(),
			//'user' => $this->User->GetList()
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
