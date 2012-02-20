<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class ErrorPage extends Page implements PageData {
	protected static $Link;
	protected $Info = array();

	public function __construct() {
		self::$Link = false;
		$this->Info['node'] = 'page.error';
		$this->Info['title'] = Language::Get('com.sbb.page.error');
	}

	public function GetInfo($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	public static function Link() {
		return self::$Link;
	}
}
?>