<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class NotificationPage extends Page implements PageData {
	protected static $Link = '?page=Notification';
	protected static $Node = 'page.notification';
	protected $Info = array();

	public function __construct() {
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = 'Notification test';
		$this->Info['template'] = 'Home';

		$Lorem = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.';
		Notification::Show($Lorem, Notification::INFO);
		Notification::Show($Lorem, Notification::SUCCESS);
		Notification::Show($Lorem, Notification::WARNING);
		Notification::Show($Lorem, Notification::ERROR);
	}

	public function GetInfo($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetWholeInfo() {
		return $this->Info;
	}

	public static function Link() {
		return self::$Link;
	}

	public static function Node() {
		return self::$Node;
	}
}
?>