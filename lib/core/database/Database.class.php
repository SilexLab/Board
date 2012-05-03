<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

require_once('DatabaseResult.interface.php');
abstract class Database {
	/**
	 * Returns a new wrapped database
	 */
	public static final function GetDatabase() {
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
	abstract public function Order($Column, $ASC = true);
	abstract public function Limit($Limit);
	// Extended Database Commands
	abstract public function Replace(array $Replaces);
	
	// Extended Queryfunctions
	abstract public function Exists();
	abstract public function Query($Query);
	
	// Execute the Command-tree
	abstract public function Execute();
	
	// MySQL functions
	abstract public function EscapeString($String);
	
	// Shortcuts (Experimental usage)
	public function T($Table)         { return $this->Table($Table); }
	public function S($Columns = '*') { return $this->Select($Columns); }
	public function I(array $Inserts) { return $this->Insert($Inserts); }
	public function U(array $Updates) { return $this->Update($Updates); }
	public function D()               { return $this->Delete(); }
	public function W($Where)         { return $this->Where($Where); }
	public function O($Column, $ASC = true) { return $this->Order($Column, $ASC); }
	public function L($Limit)         { return $this->Limit($Limit); }
	public function R(array $Replaces) { return $this->Replace($Replaces); }
	public function E()               { return $this->Exists(); }
	public function Q($Query)         { return $this->Query($Query); }
	public function Exec()            { return $this->Execute(); }
	public function EscStr($String)   { return $this->RealEscapeString($String); }
}
?>