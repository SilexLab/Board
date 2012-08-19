<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class MySQLiResult implements DatabaseResult {
	private
		$Query,
		$Database,
		$Result;

	public function __construct($Query, $DB) {
		$this->Query    = $Query;
		$this->Database = $DB;

		// Send query
		$this->Result = $DB->query($Query);
	}
	
	public function __destruct() {}

	public function FetchArray() {
		if(!$this->Result)
			return false;
		return $this->Result->fetch_assoc();
	}

	public function FetchArrays() {
		if(!$this->Result)
			return false;
		$Rows = array();
		if(false) { // Multiquery // TODO: Check if multiquery
			foreach($this->GetMultiQueryResults() as $Result) {
				$CurrentResult = array();
				while($Row = $Result->fetch_assoc()) {
					$CurrentResult[] = $Row;
				}
				$Result->close();
				$Rows[] = $CurrentResult;
			}
		} else { // Singlequery
			while($Row = $this->Result->fetch_assoc())
				$Rows[] = $Row;
			$this->Result->close();
		}
		return $Rows;
	}

	public function FetchObject() {
		if(!$this->Result)
			return false;
		return $this->Result->fetch_object();
	}

	public function FetchObjects() {
		if(!$this->Result)
			return false;
		$Rows = array();
		if(false) { // Multiquery // TODO: Check if multiquery
			foreach($this->GetMultiQueryResults() as $Result) {
				$CurrentResult = array();
				while($Row = $Result->fetch_object()) {
					$CurrentResult[] = $Row;
				}
				$Result->close();
				$Rows[] = $CurrentResult;
			}
		} else { // Singlequery
			while($Row = $this->Result->fetch_object())
				$Rows[] = $Row;
			$this->Result->close();
		}
		return $Rows;
	}

	public function NumRows() {
		if(!$this->Result)
			return false;
		return $this->Result->num_rows;
	}

	public function GetMultiQueryResults() {
		$Results = array();
		do {
			$Results[] = $this->Database->store_result();
		} while($this->Database->next_result());
		return $Results;
	}

	/* ------ */
	public function GetResult() {
		return $this->Result;
	}
}
?>