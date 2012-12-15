<?php
/**
 * @author     Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class MySQLiAction extends MySQLiWrapper {
	protected $Parent = null;
	public function __construct(MySQLiWrapper $Parent) {
		$this->Parent = $Parent;
	}
	
	public function __destruct() {}

	protected function PostConstruct() {
		$this->Database = $this->Parent->Database;
		$this->Query = $this->Parent->Query;
		$this->Action = $this->Parent->Action;
	}

	public function Execute() {
		$Query = new MySQLiMakeQuery($this->Query->GetQuery(), $this->Parent);
		$Query = $Query->Query;

		if(sizeof($this->Query->GetQuery()) > 1) {
			// Multiquery
			foreach ($this->Query->GetQuery() as $Raw) {
				if(isset($Raw[1]) && $Raw[1]['TYPE'] == 'EXISTS') {
					throw new DatabaseException('Exists requests are not allowed for multiquerys.');
				}
			}
		} else if(sizeof($this->Query->GetQuery()) == 1) {
			// Singlequery
			if(isset($this->Query->GetQuery()[0][1]['TYPE'])) {
				if($this->Query->GetQuery()[0][1]['TYPE'] == 'EXISTS') {
					// TODO: Gebe Exists dings zurück
					$this->Query->ClearQuery();
					return true ? true : false;
				}
			}
		} else
			throw new DatabaseException('ლ(ಠ益ಠლ) Y U NO JUST WRITE THE QUERY RIGHT?!', 42);

		$this->Query->ClearQuery();
		return new MySQLiResult($Query, $this->Database);
	}
}
?>