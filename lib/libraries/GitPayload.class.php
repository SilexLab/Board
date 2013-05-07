<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class GitPayload {
	private $Payload;

	public function __construct() {
		if(is_file(CFG_CACHE_DIR.'git_payload.json'))
			$this->Payload = json_decode(file_get_contents(CFG_CACHE_DIR.'git_payload.json'));
	}

	public function __get($Name) {
		return $this->Payload->{$Name};
	}
}
