<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class ErrorPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = '';
	}

	public function Display(Page $P) {
		SBB::Nav()->Crumb()->Add(Language::Get('page.error'), self::Link());
		Notification::Show(Language::Get('error.no_page'), Notification::ERROR);
		SBB::Template()->Assign(['route' => print_r($P->URI()->Get(), true)]);
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return Language::Get('page.error');
	}

	public function Template() {
		return 'PageError.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
