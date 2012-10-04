<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class ErrorPage implements PageData {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make(['page' => 'Design']);
	}

	public function Display() {
		Breadcrumb::Add(Language::Get('sbb.page.error'), self::Link());
		Notification::Show(Language::Get('sbb.error.no_page'), Notification::ERROR);
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return Language::Get('sbb.page.error');
	}

	public function Template() {
		return 'pages/Error.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
?>