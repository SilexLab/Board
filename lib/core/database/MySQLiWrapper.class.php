<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

include('Database.class.php'); // Only for coding
class MySQLiWrapper extends Database {
// Database connection
	private $Database,	// Contains the MySQLi-Object
			$ConErrNo,	// Contains the Error Number if any Error caused
			$ConError;	// Contains the Error as String -''-
	
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
			$ListIndex = 0;
	
// Database Commands
	/**
	 * Select a table from the MySQL-Database
	 * @param	string $Table
	 * ->Table($Table)
	 */
	public function Table($Table) {
		$this->Add('TABLE', $Table);
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
	public function Exectute() {
		if($this->ListIndex >= 1) {
			// Multiquery
			$Query = '';
			foreach($this->QueryList as $aQuery) {
				$Query .= SQL::Make($aQuery, false);
			}
		} else {
			// Singlequery
			$Query = SQL::Make($this->QueryList[0], true);
		}
	}
	
// Methods to get the result of a Select-tree
	public function GetResult() {
	}
	
	public function FetchArray() {
	}
	
	public function FetchArrays() {
	}
	
	public function FetchObject() {
	}
	
	public function FetchObjects() {
	}
	
// Intern methods
	/**
	 * Add a segement to a query
	 * @param	string $QuerySegment
	 */
	private function Add($QuerySegment, $Value = NULL) {
		// Create a new Query if passed
		if(in_array($QuerySegment, array('TABLE', 'SELECT', 'INSERT', 'UPDATE', 'DELETE', 'EXISTS', 'QUERY'))) {
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
}
?>