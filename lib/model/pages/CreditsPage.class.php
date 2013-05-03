<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class CreditsPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'Credits']]);
	}

	public function Display(Page $P) {
		SBB::Nav()->Crumb()->Add('Credits', self::Link());
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return 'Credits';
	}

	public function Template() {
		return 'PageCredits.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
