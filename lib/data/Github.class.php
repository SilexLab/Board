<?php
/**
 * github API client
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Github {
	protected
		$User       = null,
		$Repository = null;

	/**
	 * Instanciate a new github API client
	 * @param string $User
	 * @param string $Repository
	 */
	public function __construct($User, $Repository) {
		$this->User = $User;
		$this->Repository = $Repository;
	}

	/**
	 * Get a commit
	 * @param  string $SHA
	 * @return mixed
	 */
	public function GetCommit($SHA, $assoc = false) {
		$URL = 'https://api.github.com/repos/'.urlencode($this->User).'/'.urlencode($this->Repository).'/git/commits/'.urlencode($SHA);
		return json_decode(file_get_contents($URL), $assoc);
	}
}
?>