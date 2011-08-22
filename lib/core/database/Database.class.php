<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

abstract class Database extends SBB {
	/**
	 * @return Database
	 */
	protected static function GetDatabase() {
		$Database;
		switch(CFG_DB_TYPE) {
			case 'MySQL':
				$Database = new MySQLDatabase();
				break;
			case 'MySQLi':
				$Database = new MySQLiDatabase();
				break;
			default:
				$Database = new MySQLDatabase();
		}
		return $Database;
	}
	
	abstract public function Connect();
	abstract public function Disconnect();
	abstract public function Query($Query);
	abstract public function Select($Table, $Rows = '*', $Where = '', $Order = '', $Limit = 0);
	abstract public function Insert($Table, array $Inserts);
	abstract public function Update($Table, array $Updates, $Where);
	abstract public function Count($Table, $Rows = '*', $Where);
	abstract public function RowExists($Table, $Rows = '*', $Where);
	abstract public function NumRows();
	abstract public function AffectedRows();
	abstract public function Free();
	abstract public function FetchObject();
	abstract public function FetchArray();
	abstract public function FetchObjects();
	abstract public function FetchArrays();
	abstract public function GetObject();
	abstract public function GetArray();
	abstract public function GetObjects();
	abstract public function GetArrays();
}
?>