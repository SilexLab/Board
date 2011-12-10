<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

abstract class Database {
	/**
	 * @return Database
	 */
	public static function GetDatabase() {
		$Database;
		switch(CFG_DB_TYPE) {
			case 'MySQLi':
				return new MySQLiWrapper(CFG_DB_HOST, CFG_DB_USER, CFG_DB_PASSWORD, CFG_DB_DATABASE);
			case 'MySQL':
				// Debug-Class
				//return new MySQLWrapper(CFG_DB_HOST, CFG_DB_USER, CFG_DB_PASSWORD, CFG_DB_DATABASE);
			default:
				throw new DatabaseException('Noob, change your Databasetype to \'MySQLi\'', 1337);
		}
		return false;
	}
	
	// Connection - Disconnection
	abstract public function __construct($Host, $User, $Password, $Database, $Port = NULL, $Socket = NULL);
	abstract public function __destruct();
	
	// Database Commands
	abstract public function Table($Table);
	abstract public function Select($Columns = '*');
	abstract public function Insert(array $Inserts);
	abstract public function Update(array $Updates);
	abstract public function Delete();
	abstract public function Where($Where);
	abstract public function OrderBy($Column, $ASC = true);
	abstract public function Limit($Limit);
	
	// Extended Queryfunctions
	abstract public function Exists();
	abstract public function Query($Query);
	
	// Execute the Command-tree
	abstract public function Execute();
	
	// MySQL functions
	abstract public function RealEscapeString($String);
	
	// Methods to get the result of a Select-tree
	abstract public function FetchArray();
	abstract public function FetchArrays();
	abstract public function FetchObject();
	abstract public function FetchObjects();
	abstract public function NumRows();
}
?>