<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class HomePage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = '!-!HOME LINK!-!';
		echo 'Home augerufen!';
	}

	public function Display(Page $P) {
		echo 'Tu irgend etwas und zeige die Seite an!';
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return '!-!HOME TITLE!-!';
	}

	public function Template() {
		return 'pages/Home.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}