<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class BlubPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = '!-!BLUB LINK!-!';
		echo 'Blub augerufen!';
	}

	public function Display(Page $P) {
		echo $P->Link('Home');
		echo 'Blub irgend etwas und blub die Seite!';
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return '!-!BLUB TITLE!-!';
	}

	public function Template() {
		return 'pages/Blub.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}