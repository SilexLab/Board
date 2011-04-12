<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

class mysqlQuery {
	protected static $sql = '';
	protected static $errno = 0;
	protected static $error = '';
	protected static $result;

	protected static function ExecuteQuery() {
		self::$result = mysql_query(self::$sql);
		if(!self::$result) {
			self::$errno = mysql_errno();
			self::$error = mysql_error();
			die(self::GetError());
		}
	}
	
	public static function SQL($sql) {
		self::$sql = $sql;
		self::ExecuteQuery();
	}
	
	public static function GetError() {
		$str  =  "<h2 style=\"display:block;\">Fatal MySQL Error:</h2>\n"
				."	<b>Errorcode</b>: ".self::$errno."<br />\n"
				."	<b>Error</b>: ".self::$error."<br />"
				."	<b>Query</b>:<div style=\"padding:0 0 0 20px;\"><pre>".self::$sql."</pre></div><br />\n"
				."	<b>File</b>: ".__FILE__."<br />\n"
				."	<b>Site</b>: ".(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? htmlentities($_SERVER['REQUEST_URI']) : "-")."<br />\n"
				."	<b>Referrer</b>: ".(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? htmlentities($_SERVER['HTTP_REFERER']) : "-")."<br />\n"
				."</div>\n";
		return $str;
	}
	public static function FetchObject() {
		return mysql_fetch_object(self::$result);
	}
	public static function FetchArray() {
		return mysql_fetch_assoc(self::$result);
	}
	public static function NumRows() {
		return mysql_num_rows(self::$result);
	}
	public static function AffectedRows() {
		return mysql_affected_rows(self::$result);
	}

	public static function Update($table, $updates, $where) {
		$update = 'UPDATE '.$table.' SET ';

		foreach($updates as $key => $value) {
			$update .= $key.' = \''.$value.'\', ';
		}		
    
		$update = trim($update, ', ');
		
		$update .= ' WHERE '.$where;
		
		$update .= ';';

		self::$sql = $update;
		self::ExecuteQuery();
	}
	public static function Select($table, $rows = '*', $where = '', $order = '', $limit = '') {
		$query = 'SELECT '.$rows.' FROM '.$table;
		if(!empty($where)) {
			$query .= ' WHERE '.$where;
		}
		if(!empty($order)) {
			$query .= ' ORDER BY '.$order;
		}
		if(!empty($limit)) {
			$query .= ' LIMIT '.$limit;
		}
		$query .= ';';

		self::$sql = $query;
		self::ExecuteQuery();
	}
	public static function Delete($table, $where = '') {
		if(empty($where)) {
			$query = 'DELETE '.$table;
		}
		else if(!empty($where)) {
			$query = 'DELETE FROM '.$table.' WHERE '.$where.';';
		}
		else {
			die('Something went wrong :O');
		}

		self::$sql = $query;
		self::ExecuteQuery();
	}
	public static function Insert($table, $inserts) {
		$begin  = false;
		$insert = 'INSERT INTO '.$table.' (';

		foreach($inserts as $key => $value) {
			if($begin == false)	{
				$insert .= $key;
				$begin = true;
			}
			else {
				$insert .= ', '.$key;
			}
		}
		$insert .= ') VALUES (';
		$begin = false;
		foreach($inserts as $key => $value) {
			if($begin == false)	{
				$insert .= "'".$value."'";
				$begin   = true;
			}
			else $insert .= ', \''.$value.'\'';
		}
		$insert .= ')';
		
		$insert .= ';';

		self::$sql = $insert;
		self::ExecuteQuery();
	}
	
	public static function Free() {
		mysql_free_result(self::$result);
	}
}
?>