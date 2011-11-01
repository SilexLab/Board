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
// Database Commands
	/**
	 * Select a table from the MySQL-Database
	 * @param	string $Table
	 * ->Table($Table)
	 */
	public function Table($Table) {
	}
	
	/**
	 * Select columns from the table
	 * @param	string $Columns	('Column')
	 * @param	array $Columns	(array('Column' => 'Value'))
	 * ->Table($Table)->Select($Columns)
	 */
	public function Select($Columns = '*') {
	}
	
	/**
	 * Insert values into the table
	 * @param	array $Inserts	(array('Column' => 'Value'))
	 * ->Table($Table)->Insert($Insert)
	 */
	public function Insert(array $Inserts) {
	}
	
	/**
	 * Update values in the table
	 * @param	array $Updates	(array('Column' => 'Value'))
	 * ->Table($Table)->Update($Updates)
	 */
	public function Update(array $Updates) {
	}
	
	/**
	 * Delete a row
	 * ->Table($Table)->Delete()
	 */
	public function Delete() {
	}
	
	/**
	 * Specify where the previous command shall do things
	 * @param	string $Column, string $Operator, mixed $Value (no arrays)
	 * [...]->Where($Column, $Operator, $Value)
	 */
	public function Where($Column, $Operator, $Value) {
	}
	
	/**
	 * Order the SELECT query
	 * @param	string $Column, optional bool $ASC
	 * [...]->Select($Columns)->[...]->OrderBy($Column, $ASC)
	 */
	public function OrderBy($Column, $ASC = true) {
	}
	
	/**
	 * Limitate the SELECT query
	 * @param	int $Limit
	 * [...]->Select($Columns)->[...]->Limit($Limit)
	 */
	public function Limit($Limit) {
	}
	
// Extended Queryfunctions
	/**
	 * Check if the row exists.
	 * Table($Table)->Exists()->Where([...])
	 */
	public function Exists() {
	}
	
	/**
	 * Create a custom query
	 * @param	string $Query
	 */
	public function Query($Query) {
	}
	
	
// Execute the Command-tree
	/**
	 * Send the query(s) to the database
	 */
	public function Exectute() {
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
	
// Intern methodes
	/**
	 * Add a segement to a query
	 * @param	string $QuerySegment
	 */
	private function AddSegment($QuerySegment) {
	}
	/**
	 * Add a complete query to the querylist
	 */
	private function AddQuery() {
	}
}
?>