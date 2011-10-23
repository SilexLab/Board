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
}
?>