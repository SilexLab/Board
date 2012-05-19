<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class HomePage extends Page implements PageData {
	protected static $Link = './';
	protected static $Node = 'page.home';
	protected $Info = array();

	public function __construct() {
		// Redirect on ?page=Home
		if(URI::Get('page') == 'Home')
			header('location: ./');

		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('sbb.page.home');
		$this->Info['template'] = 'Home';
		
		SBB::Template()->Set(array('Username' => SBB::User()->GetName()));
	}

	public function GetInfo($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	protected function GetWholeInfo() {
		return $this->Info;
	}

	public static function Link() {
		return URI::Make(self::$Link);
	}

	public static function Node() {
		return self::$Node;
	}
}
?>