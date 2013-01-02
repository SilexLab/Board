<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class MySQLiQuery extends MySQLiWrapper {
	protected
		$Parent = null,
		$LastTable = false,
		$QueryIndex = -1,
		$QueryList  = array();

	public function __construct(MySQLiWrapper $Parent) {
		$this->Parent = $Parent;
	}
	
	public function __destruct() {}

	protected function PostConstruct() {
		$this->Database = $this->Parent->Database;
		$this->Query = $this->Parent->Query;
		$this->Action = $this->Parent->Action;
	}

	/* Layer 0 */
	public function Query($Query) { $this->Add('QUERY', $Query, 0); return $this; }
	public function Table($Table) { $this->Add('TABLE', $Table, 0); return $this; }

	/* Layer 1 */
	public function Select($Columns = '*')   { $this->Add('SELECT', $Columns, 1); return $this; }
	public function Insert(array $Inserts)   { $this->Add('INSERT', $Inserts, 1); return $this; }
	public function Update(array $Updates)   { $this->Add('UPDATE', $Updates, 1); return $this; }
	public function Replace(array $Replaces) { $this->Add('REPLACE', $Replaces, 1); return $this; }
	public function Delete()                 { $this->Add('DELETE', true, 1); return $this; }
	public function Exists()                 { $this->Add('EXISTS', true, 1); return $this; }

	/* Specify Query | Layer 2 */
	public function Where($Where)               { $this->Add('WHERE', $Where, 2); return $this; }
	public function Order($Column, $ASC = true) { $this->Add('ORDER', array($Column, $ASC), 2); return $this; }
	public function Limit($Limit)               { $this->Add('LIMIT', $Limit, 2); return $this; }

	public function GetQuery() {
		return $this->QueryList;
	}

	public function ClearQuery() {
		$this->LastTable = false;
		if(isset($this->QueryList[$this->QueryIndex][0]['TABLE']))
			$this->LastTable = $this->QueryList[$this->QueryIndex][0]['TABLE'];
		$this->QueryList = array();
		$this->QueryIndex = -1;
	}

	private function Add($Type, $Value, $Layer) {
		if($this->LastTable && $Type != 'QUERY') {
			if($Type != 'TABLE')
				$this->QueryList[++$this->QueryIndex][0]['TABLE'] = $this->LastTable;
			$this->LastTable = false;
		}

		if($Layer == 0) {
			$this->QueryIndex++;
		} else if($Layer == 1 && isset($this->QueryList[$this->QueryIndex][1])) {
			if(isset($this->QueryList[$this->QueryIndex][0]['TABLE']))
				$this->QueryList[++$this->QueryIndex][0] = $this->QueryList[$this->QueryIndex - 1][0];
			else
				throw new DatabaseException('The table is not specified in your query!', 0);
		} else if($Layer == 2) {
			$Size = sizeof($this->QueryList[$this->QueryIndex]);
			if($Size < 2)
				throw new DatabaseException('Something is wrong wit the query. Some infos are may missed.', 0);
			$Layer = $Size;
		}

		if($Layer == 1) {
			$this->QueryList[$this->QueryIndex][$Layer]['TYPE'] = $Type;
			$this->QueryList[$this->QueryIndex][$Layer]['VALUE'] = $Value;
		} else
			$this->QueryList[$this->QueryIndex][$Layer][$Type] = $Value;
	}
}
?>