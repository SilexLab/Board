<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Nav {
	protected $Site;
	protected $Sub;
	protected $User;

	public function __construct() {
		if(!$this->Site)
			$this->Site = new SiteNav();
		if(!$this->Sub)
			$this->Sub  = new SubNav();
		if(!$this->User)
			$this->User = new UserNav();

		// Check
		if(!($this->Site instanceof AbstractNav))
			throw new SystemException('Invalid site navigation');
		if(!($this->Sub instanceof AbstractNav))
			throw new SystemException('Invalid sub navigation');
		if(!($this->User instanceof AbstractNav))
			throw new SystemException('Invalid user navigation');
	}

	/**
	 * This should be called if the navigation processing is finished
	 * and before the templates compile
	 */
	public function Assign() {
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
