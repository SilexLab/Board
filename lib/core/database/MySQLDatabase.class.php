<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

class MySQLDatabase extends Database {
	// MySQL Connection Infos
	private $Host, $Username, $Password, $Database;
	
	// MySQL-Query Variables
	private $SQLQuery, $Result, $Object = false, $Array = false, $Objects = false, $Arrays = false;
	
	public function Connect() {
		$this->Host		= CFG_DB_HOST;
		$this->Username	= CFG_DB_USER;
		$this->Password	= CFG_DB_PASSWORD;
		$this->Database	= CFG_DB_DATABASE;
		
		$this->DoConnect();
		$this->SelectDB();
	}
	
	public function Disconnect() {
		mysql_close();
	}
	
	public function Query($Query) {
		$this->SQLQuery = $Query;
		$this->ExecuteQuery();
	}
	
	public function Select($Table, $Rows = '*', $Where = '', $Order = '', $Limit = 0) {
		$Query = 'SELECT '.$Rows.' FROM `'.CFG_DB_PREFIX.$Table.'`';
		if(!empty($Where))
			$Query .= ' WHERE '.$Where;
		if(!empty($Order))
			$Query .= ' ORDER BY '.$Order;
		if($Limit > 0)
			$Query .= ' LIMIT '.$Limit;
		$Query .= ';';
		
		$this->SQLQuery = $Query;
		return $this->ExecuteQuery();
	}
	
	public function Insert($Table, array $Inserts) {
		if(!is_array($Inserts))
			return false;
		
		$Keys = '';
		$Values = '';
		foreach($Inserts as $Key => $Value) {
			$Keys .= $Key.', ';
			$Values .= '\''.$Value.'\', ';
		}
		$Keys = trim($Keys, ', ');
		$Values = trim($Values, ', ');
		
		$this->SQLQuery = 'INSERT INTO `'.CFG_DB_PREFIX.$Table.'` ('.$Keys.') VALUES ('.$Values.');';
		return $this->ExecuteQuery();
	}
	
	public function Update($Table, array $Updates, $Where) {
		if(!is_array($Updates))
			return false;
		
		$Update = '';
		foreach($Updates as $Key => $Value)
			$Update .= $Key.' = \''.$Value.'\', ';
		$Update = trim($Update, ', ');
		
		$this->SQLQuery = 'UPDATE `'.CFG_DB_PREFIX.$Table.'` SET '.$Update.' WHERE '.$Where.';';
		return $this->ExecuteQuery();
	}
	
	public function Count($Table, $Rows = '*', $Where) {
		$this->SQLQuery = 'SELECT COUNT('.$Rows.') AS total FROM `'.CFG_DB_PREFIX.$Table.'` WHERE '.$Where.';';		
		return $this->ExecuteQuery();
	}
	
	public function RowExists($Table, $Where) {
		//$query = mysql_query('SELECT * FROM `'.$Table.'` WHERE `Wert` = \'Value\'');
		$query = mysql_query('SELECT * FROM `'.$Table.'` WHERE '.$Where.';');
		return mysql_num_rows($query) === 0 ? false : true;
	}
	
	public function Delete($Table, $Where = '') {
		$Query = 'DELETE ';
		if(empty($Where))
			$Query .= $Table;
		else if(!empty($Where))
			$Query .= 'FROM `'.CFG_DB_PREFIX.$Table.'` WHERE '.$Where.';';
		else
			die('If you see this message, you caused a error wich never can be triggered<br>'."\n".'<strong>Congratulations</strong>');
		
		$this->SQLQuery = $Query;
		return $this->ExecuteQuery();
	}
	
	public function FetchObject() {
		return mysql_fetch_object($this->Result);
	}
	
	public function FetchArray() {
		return mysql_fetch_assoc($this->Result);
	}
	
	public function NumRows() {
		return mysql_num_rows($this->Result);
	}
	
	public function AffectedRows() {
		return mysql_affected_rows($this->Result);
	}
	
	public function Free() {
		mysql_free_result($this->Result);
	}
	
	public function FetchObjects() {
		$Objects = array();
		while($row = $this->FetchObject())
			$Objects[] = $row;
		
		return $Objects;
	}
	
	public function FetchArrays() {
		$Objects = array();
		while($row = $this->FetchArray())
			$Objects[] = $row;
		
		return $Objects;
	}
	
	private function ExecuteQuery() {
		// TODO: Check if database data exists, if not: return;
		$this->Result = mysql_query($this->SQLQuery);
		if(!$this->Result)
			die('<h2>Fatal MySQL Error:</h2>'."\n".
				'	<strong>Errorcode</strong>: '.mysql_errno().'<br>'."\n".
				'	<strong>Error</strong>: '.mysql_error().'<br>'."\n".
				'	<strong>Query</strong>:
					<div style="padding:0 0 0 20px;"><pre>'.$this->SQLQuery.'</pre></div><br>'."\n".
				'	<strong>File</strong>: '.__FILE__.'<br>'."\n".
				'	<strong>Site</strong>: '.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ?
												htmlentities($_SERVER['REQUEST_URI']) : '-').'<br>'."\n".
				'	<strong>Referrer</strong>: '.(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ?
												htmlentities($_SERVER['HTTP_REFERER']) : '-'));
		return $this->Check();
	}
	
	private function DoConnect() {
		$Connect = @mysql_connect($this->Host, $this->Username, $this->Password);
		if(!$Connect) {
			die('<h2>Fatal Error:</h2>'."\n".
				'	<strong>Couldn\'t connect to the MySQL-User \''.$this->Username.'\'!</strong><br>'."\n".
				'	<strong>Errorcode</strong>: '.mysql_errno().'<br>'."\n".
				'	<strong>Error</strong>: '.mysql_error().'<br>'."\n".
				'	<strong>Site</strong>: '.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ?
												htmlentities($_SERVER['REQUEST_URI']) : '-').'<br>'."\n".
				'	<strong>Referrer</strong>: '.(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ?
													htmlentities($_SERVER['HTTP_REFERER']) : '-'));
		}
		return true;
	}
	
	private function SelectDB() {
		$Select = @mysql_select_db($this->Database);
		if(!$Select) {
			die('<h2>Fatal Error:</h2>'."\n".
				'	<strong>Can\'t find database \''.$this->Database.'\'!</strong><br>'."\n".
				'	<strong>Errorcode</strong>: '.mysql_errno().'<br>'."\n".
				'	<strong>Error</strong>: '.mysql_error().'<br>'."\n".
				'	<strong>Site</strong>: '.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ?
												htmlentities($_SERVER['REQUEST_URI']) : '-').'<br>'."\n".
				'	<strong>Referrer</strong>: '.(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ?
													htmlentities($_SERVER['HTTP_REFERER']) : '-'));
		}
		return true;
	}
	
	
	/**
	 * Shorthanded functions
	 * Call one of these, e.g.: $Result = SBB::SQL->GetObject()->Select();
	 */
	public function GetObject() {
		$this->Object = true;
		return $this;
	}
	
	public function GetArray() {
		$this->Array = true;
		return $this;
	}
	
	public function GetObjects() {
		$this->Objects = true;
		return $this;
	}
	
	public function GetArrays() {
		$this->Arrays = true;
		return $this;
	}
	
	private function Check() {
		if($this->Object) {
			$this->Object = false;
			return $this->FetchObject();
		}
		if($this->Array) {
			$this->Array = false;
			return $this->FetchArray();
		}
		if($this->Objects) {
			$this->Objects = false;
			return $this->FetchObjects();
		}
		if($this->Arrays) {
			$this->Arrays = false;
			return $this->FetchArrays();
		}
	}
}
?>