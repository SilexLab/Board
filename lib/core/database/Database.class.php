<?php
/**
 * @author     SilexBB
 * @copyright  2011 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

abstract class Database {
	/**
	 * @return Database
	 */
	public static function GetDatabase() {
		$Database;
		switch(strtolower(CFG_DB_TYPE)) {
			case 'mysqli':
				return new MySQLiWrapper(CFG_DB_HOST, CFG_DB_USER, CFG_DB_PASSWORD, CFG_DB_DATABASE);
			case 'mysql':
				//return new MySQLWrapper(CFG_DB_HOST, CFG_DB_USER, CFG_DB_PASSWORD, CFG_DB_DATABASE);
			default:
				throw new DatabaseException('Change your Database type to \'MySQLi\'', 1337);
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
	abstract public function Execute($GetResult = false);
	
	// MySQL functions
	abstract public function RealEscapeString($String);
	
	// Methods to get the result of a Select-tree
	abstract public function FetchArray();
	abstract public function FetchArrays();
	abstract public function FetchObject();
	abstract public function FetchObjects();
	abstract public function NumRows();
	
	// Shortcuts
	public function T($Table)         { return $this->Table($Table); }
	public function S($Columns = '*') { return $this->Select($Columns); }
	public function I(array $Inserts) { return $this->Insert($Inserts); }
	public function U(array $Updates) { return $this->Update($Updates); }
	public function D()               { return $this->Delete(); }
	public function W($Where)         { return $this->Where($Where); }
	public function O($Column, $ASC = true) { return $this->OrderBy($Column, $ASC); }
	public function L($Limit)         { return $this->Limit($Limit); }
	public function E()               { return $this->Exists(); }
	public function Q($Query)         { return $this->Query($Query); }
	public function Exec($GR = false) { return $this->Execute($GR); }
	public function EscStr($String)   { return $this->RealEscapeString($String); }
}
?>