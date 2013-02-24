<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class AboutPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'About']]);
	}

	public function Display(Page $P) {
		Breadcrumb::Add('About', self::Link());
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return 'About';
	}

	public function Template() {
		return 'PageAbout.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
