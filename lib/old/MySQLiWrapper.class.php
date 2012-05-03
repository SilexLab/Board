<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class MySQLiWrapper extends Database {
// Database connection
	private $Database,	// Contains the MySQLi-Object
			$ConErrNo,	// Contains the Error Number if any Error caused
			$ConError;	// Contains the Error as String -''-
	
	private static $cHost, $cUser, $cPassword, $cDatabase, $cPort, $cSocket;
	
	/**
	 * Open a new MySQLi connection
	 */
	public function __construct($Host, $User, $Password, $Database, $Port = NULL, $Socket = NULL) {
		$this->Database = @new MySQLi($Host, $User, $Password, $Database, $Port, $Socket);
		
		if($this->Database->connect_errno)
			throw new DatabaseException($this->Database->connect_error, $this->Database->connect_errno);
	}
	
	/**
	 * Close the MySQLi connection
	 */
	public function __destruct() {
		$this->Database->close();
	}
	
// SQL Handle
	private $QueryList = array(),
			$ListIndex = -1;
	
// SQL Results
	private $Result,
			$Exists;
	
// Database Commands
	/**
	 * Select a table from the MySQL-Database
	 * @param	string $Table
	 * ->Table($Table)
	 */
	public function Table($Table) {
		$this->Add('TABLE', CFG_DB_PREFIX.$Table);
		return $this;
	}
	
	/**
	 * Select columns from the table
	 * @param	string $Columns	('Column')
	 * @param	array $Columns	(array('Column' => 'Value'))
	 * ->Table($Table)->Select($Columns)
	 */
	public function Select($Columns = '*') {
		$this->Add('SELECT', $Columns);
		return $this;
	}
	
	/**
	 * Insert values into the table
	 * @param	array $Inserts	(array('Column' => 'Value'))
	 * ->Table($Table)->Insert($Insert)
	 */
	public function Insert(array $Inserts) {
		$this->Add('INSERT', $Inserts);
		return $this;
	}
	
	/**
	 * Replace values in a row
	 * @param	array $Replaces	(array('Column' => 'Value'))
	 * ->Table($Table)->Replace($Updates)
	 */
	public function Replace(array $Replaces) {
		$this->Add('REPLACE', $Replaces);
		return $this;
	}
	
	/**
	 * Update values in the table
	 * @param	array $Updates	(array('Column' => 'Value'))
	 * ->Table($Table)->Update($Updates)
	 */
	public function Update(array $Updates) {
		$this->Add('UPDATE', $Updates);
		return $this;
	}
	
	/**
	 * Delete a row
	 * ->Table($Table)->Delete()
	 */
	public function Delete() {
		$this->Add('DELETE');
		return $this;
	}
	
	/**
	 * Specify where the previous command shall do things
	 * @param	string $Where
	 * [...]->Where($Where)
	 */
	public function Where($Where) {
		$this->Add('WHERE', $Where);
		return $this;
	}
	
	/**
	 * Order the SELECT query
	 * @param	string $Column, optional bool $ASC
	 * [...]->Select($Columns)->[...]->OrderBy($Column, $ASC)
	 */
	public function OrderBy($Column, $ASC = true) {
		$this->Add('ORDER', array($Column, $ASC));
		return $this;
	}
	
	/**
	 * Limitate the SELECT query
	 * @param	int $Limit
	 * [...]->Select($Columns)->[...]->Limit($Limit)
	 */
	public function Limit($Limit) {
		$this->Add('LIMIT', $Limit);
		return $this;
	}
	
// Extended Queryfunctions
	/**
	 * Check if the row exists.
	 * Table($Table)->Exists()->Where([...])
	 */
	public function Exists() {
		$this->Add('EXISTS');
		return $this;
	}
	
	/**
	 * Create a custom query
	 * @param	string $Query
	 */
	public function Query($Query) {
		$this->Add('QUERY', $Query);
		return $this;
	}
	
	
// Execute the Command-tree
	/**
	 * Send the query(s) to the database
	 */
	public function Execute($GetResult = false) {
		$Query = '';
		if($this->ListIndex >= 1) { // Multiquery
			$SelectCount = 0;
			
			foreach($this->QueryList as $aQuery) {
				if(isset($aQuery['EXISTS']))
					throw new DatabaseException('Exists requests are not allowed for multiquery, use a singlequery.', 0);
				
				$Query .= ' '.SQL::Make($aQuery, $this, false);
			}
			$Query = trim($Query);
			
			// Send
			$this->Database->multi_query($Query);
			$this->Result = 'MULTIQUERY';
		} else { // Singlequery
			$Query = '';
			if(isset($this->QueryList[0]))
				$Query = SQL::Make($this->QueryList[0], $this, false); // Do not use prepared statements
			else
				throw new DatabaseException('Error while parsing the query');
				
			
			// Send
			$this->Result = $this->Database->query($Query);
			
			if(isset($this->QueryList[0]['EXISTS'])) {
				$this->ListIndex = -1;
				$this->QueryList = NULL;
				return $this->Result->num_rows === 0 ? false : true;
			}
		}
		
		// Clear
		$this->ListIndex = -1;
		$this->QueryList = NULL;
		
		if(!$this->Result)
			return false;
		return $GetResult ? $this->Result : $this;
	}
	
// MySQL functions
	public function EscapeString($String) {
		return $this->Database->real_escape_string($String);
	}
	
	public function IsConnected() {
		return $this->Database ? true : false;
	}
	
// Methods to get the result of a Select-tree
	public function FetchArray() {
		if(!$this->Result)
			return false;
		if($this->Result === 'MULTIQUERY') // Multiquery not possible
			return false;
		
		// Singlequery
		return $this->Result->fetch_assoc();
	}
	
	public function FetchArrays() {
		if(!$this->Result)
			return false;
		$Rows = array();
		if($this->Result === 'MULTIQUERY') { // Multiquery
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
	}
	
	public function FetchObject() {
		if(!$this->Result)
			return false;
		if($this->Result === 'MULTIQUERY') // Multiquery not possible
			return false;
		
		// Singlequery
		return $this->Result->fetch_object();
	}
	
	public function FetchObjects() {
		if(!$this->Result)
			return false;
		$Rows = array();
		if($this->Result === 'MULTIQUERY') { // Multiquery
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
	
// Intern methods
	/**
	 * Add a segement to a query
	 * @param	string $QuerySegment
	 */
	private function Add($QuerySegment, $Value = NULL) {
		if(!$this->IsConnected()) {
			echo 'NICHT VERBUNDEN!!!<br>';
		}
		
		// Clear old results
		$this->Result = NULL;
		$this->Exists = NULL;
		
		// Create a new Query if passed
		if(in_array($QuerySegment, array('TABLE', 'SELECT', 'INSERT', 'REPLACE', 'UPDATE', 'DELETE', 'EXISTS', 'QUERY'))) {
			if($QuerySegment == 'TABLE' || $QuerySegment == 'QUERY')
				$this->ListIndex++;
			else if(isset($this->QueryList[$this->ListIndex]['TABLE']) && sizeof($this->QueryList[$this->ListIndex]) > 1) {
				// Keep table
				$Table = $this->QueryList[$this->ListIndex]['TABLE'];
				$this->ListIndex++;
				$this->QueryList[$this->ListIndex]['TABLE'] = $Table;
				unset($Table);
			}
		}
		// Write the query segment
		$this->QueryList[$this->ListIndex][$QuerySegment] = $Value ? $Value : $QuerySegment;
	}
	
	/**
	 * Saves all results into an array
	 * @return	array
	 */
	private function GetMultiQueryResults() {
		$Results = array();
		do {
			$Results[] = $this->Database->store_result();
		} while($this->Database->next_result());
		
		return $Results;
	}
}
?>