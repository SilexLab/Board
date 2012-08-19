<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class MySQLiWrapper extends Database {
	protected
		$Database = null,
		$Query    = null,
		$Action   = null;

	/**
	 * Open a new MySQLi connection
	 * @param string $Host
	 * @param string $User
	 * @param string $Password
	 * @param string $Database
	 * @param int    $Port
	 * @param string $Socket
	 */
	public function __construct($Host, $User, $Password, $Database, $Port = null, $Socket = null) {
		$this->Database = @new mysqli($Host, $User, $Password, $Database, $Port, $Socket);
		if($this->Database->connect_errno)
			throw new DatabaseException($this->Database->connect_error, $this->Database->connect_errno);
		$this->Action = new MySQLiAction($this);
		$this->Query = new MySQLiQuery($this);
		$this->Action->PostConstruct();
		$this->Query->PostConstruct();
	}

	/**
	 * Close the MySQLi connection
	 */
	public function __destruct() {
		$this->Database->close();
		unset($this->Query);
		unset($this->Action);
	}

	/* Wrapped Query Methods */
	public function Query($Query) { return $this->Query->Query($Query); }
	public function Table($Table) { return $this->Query->Table($Table); }
	public function Select($Columns = '*') { return $this->Query->Select($Columns); }
	public function Insert(array $Inserts) { return $this->Query->Insert($Inserts); }
	public function Update(array $Updates) { return $this->Query->Update($Updates); }
	public function Delete() { return $this->Query->Delete(); }
	public function Where($Where) { return $this->Query->Where($Where); }
	public function Order($Column, $ASC = true) { return $this->Query->Order($Column, $ASC); }
	public function Limit($Limit) { return $this->Query->Limit($Limit); }
	public function Replace(array $Replaces) { return $this->Query->Replace($Replace); }
	public function Exists() { return $this->Query->Exists(); }

	/* Wrapped Action Methods */
	public function Execute() { return $this->Action->Execute(); }

	/* Extended Database Actions */
	public function EscapeString($String) {
		return $this->Database->real_escape_string($String);
	}
}
?>