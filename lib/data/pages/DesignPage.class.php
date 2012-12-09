<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class DesignPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'Design']]);
	}

	public function Display(Page $P) {
		Breadcrumb::Add('Designtest', self::Link());
		
		if($P->URI()->Get('notification') !== false) {
			$Lorem = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.';
			$LoremLong = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.';
			Notification::Show($LoremLong, Notification::INFO);
			Notification::Show($Lorem, Notification::SUCCESS);
			Notification::Show($LoremLong, Notification::WARNING);
			Notification::Show($Lorem, Notification::ERROR);
			Notification::Show($LoremLong, Notification::NEUTRAL);
		}

	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return 'Designtest';
	}

	public function Template() {
		return 'PageDesign.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
