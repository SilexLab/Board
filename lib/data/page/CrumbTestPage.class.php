<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class CrumbTestPage extends Page implements PageData {
	protected static $Link = ['page' => 'CrumbTest'];
	protected static $Node = 'page.crumbtest';
	protected $Info = array();

	public function __construct() {
		$this->Info['node'] = self::$Node;
		$this->Info['title'] = 'Crumb Test';
		Breadcrumb::Add('ASDF', self::Link());
		Breadcrumb::Add('Foo', self::Link());
		Breadcrumb::Add('Bar', self::Link());
		Breadcrumb::Add('Bum', self::Link());
		Breadcrumb::Add('Bam', self::Link());
		Breadcrumb::Add('Si 23 f', self::Link());
		Breadcrumb::Add('Do rwe3', self::Link());
		Breadcrumb::Add('Fu qr ', self::Link());
		Breadcrumb::Add('Fa qwr', self::Link());
		Breadcrumb::Add('KK asd', self::Link());
		Breadcrumb::Add('ASDF JKLÖ', self::Link());
		Breadcrumb::Add('Loooooooooooooooooooooooooooooooong', self::Link());
		Breadcrumb::Add('Bluuuuub', self::Link());
		Breadcrumb::Add('Blabbbbbbb', self::Link());
		Breadcrumb::Add('Blööööööööööööööööööbbbbbbb', self::Link());
		Breadcrumb::Add('Aledo le blä', self::Link());
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