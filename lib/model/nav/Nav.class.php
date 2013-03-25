<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

abstract class Nav {
	protected static $Site;
	protected static $Sub;
	protected static $User;

	public static function Initial() {
		if(!self::$Site)
			self::$Site = new SiteNav();
		if(!self::$Sub)
			self::$Sub  = new SubNav();
		if(!self::$User)
			self::$User = new UserNav();
	}

	/**
	 * This should be called if the navigation processing is finished
	 * and before the templates compile
	 */
	public static function Assign() {
		self::Initial();

		SBB::Template()->Assign(['nav' => [
			'site' => self::$Site->GetList()
			//'sub' => self::$Sub->GetList(),
			//'user' => self::$User->GetList()
		]]);
	}

	/**
	 * Return the main (site) navigation object
	 * @return  SiteNav
	 */
	public static function Site() {
		self::Initial();

		return self::$Site;
	}

	/**
	 * Return the sub page navigation object
	 * @return  SubNav
	 */
	public static function Sub() {
		self::Initial();

		return self::$Sub;
	}

	/**
	 * Return the user navigation object
	 * @return  UserNav
	 */
	public static function User() {
		self::Initial();

		return self::$User;
	}

	abstract protected function GetList();
	abstract public function Add($Name, $Link, $Target = false);
	abstract public function Remove($Name);
}
