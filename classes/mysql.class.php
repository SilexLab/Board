<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 2
 */

class mysql{
	// MySQL Connection Infos
	private static $Host, $Username, $Password, $Database;
	
	// MySQL-Query Variables
	private static $SQLQuery, $Result;
	
	// Initial MySQL Connection
	public static function Connect($Host, $Username, $Password, $Database) {		
		self::$Host		= $Host;
		self::$Username	= $Username;
		self::$Password	= $Password;
		self::$Database	= $Database;
    
		self::DoConnect();
		self::SelectDB();
	}
	
	public static function Query($Query) {
		self::$SQLQuery = $Query;
		self::ExecuteQuery();
	}
	
	public static function Select($Table, $Rows = '*', $Where = '', $Order = '', $Limit = 0) {
		$Query = 'SELECT '.$Rows.' FROM '.DB_PREFIX.$Table;
		if(!empty($Where))
			$Query .= ' WHERE '.$Where;
		if(!empty($Order))
			$Query .= ' ORDER BY '.$Order;
		if($Limit > 0)
			$Query .= ' LIMIT '.$Limit;
		$Query .= ';';
		
		self::$SQLQuery = $Query;
		self::ExecuteQuery();
	}
	
	public static function Insert($Table, $Inserts) {
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
		
		self::$SQLQuery = 'INSERT INTO '.DB_PREFIX.$Table.' ('.$Keys.') VALUES ('.$Values.');';
		self::ExecuteQuery();
	}
	
	public static function Update($Table, $Updates, $Where) {
		if(!is_array($Updates))
			return false;
		
		$Update = '';
		foreach($Updates as $Key => $Value)
			$Update .= $Key.' = \''.$Value.'\', ';
		$Update = trim($Update, ', ');
		
		self::$SQLQuery = 'UPDATE '.DB_PREFIX.$Table.' SET '.$Update.' WHERE '.$Where.';';
		self::ExecuteQuery();
	}
	
	public static function Count($Table, $Rows = '*', $Where) {
		self::$SQLQuery = 'SELECT COUNT('.$Rows.') AS total FROM '.DB_PREFIX.$Table.' WHERE '.$Where.';';		
		self::ExecuteQuery();
	}
	
	public static function Delete($Table, $Where = '') {
		$Query = 'DELETE ';
		if(empty($Where))
			$Query .= $Table;
		else if(!empty($Where))
			$Query .= 'FROM '.DB_PREFIX.$Table.' WHERE '.$Where.';';
		else
			die('If you see this message, you caused a error wich never can be triggered<br>'."\n".'<strong>Congratulations</strong>');
		
		self::$SQLQuery = $Query;
		self::ExecuteQuery();
	}
	
	public static function FetchObject() {
		return mysql_fetch_object(self::$Result);
	}
	
	public static function FetchArray() {
		return mysql_fetch_assoc(self::$Result);
	}
	
	public static function NumRows() {
		return mysql_num_rows(self::$Result);
	}
	
	public static function AffectedRows() {
		return mysql_affected_rows(self::$Result);
	}
	
	public static function Free() {
		mysql_free_result(self::$Result);
	}
	
	public static function GetObjects() {
		$Objects = array();
		while($row = mysql::FetchObject())
			$Objects[] = $row;
		
		return $Objects;
	}
	
	private static function ExecuteQuery() {
		self::$Result = mysql_query(self::$SQLQuery);
		if(!self::$Result)
			die('<h2>Fatal MySQL Error:</h2>'."\n".
				'	<strong>Errorcode</strong>: '.mysql_errno().'<br>'."\n".
				'	<strong>Error</strong>: '.mysql_error().'<br>'."\n".
				'	<strong>Query</strong>:
					<div style="padding:0 0 0 20px;"><pre>'.self::$SQLQuery.'</pre></div><br>'."\n".
				'	<strong>File</strong>: '.__FILE__.'<br>'."\n".
				'	<strong>Site</strong>: '.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ?
												htmlentities($_SERVER['REQUEST_URI']) : '-').'<br>'."\n".
				'	<strong>Referrer</strong>: '.(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ?
												htmlentities($_SERVER['HTTP_REFERER']) : '-'));
	}
	
	private static function DoConnect() {
		$Connect = @mysql_connect(self::$Host, self::$Username, self::$Password);
		if(!$Connect) {
			die('<h2>Fatal Error:</h2>'."\n".
				'	<strong>Couldn\'t connect to the MySQL-User \''.self::$Username.'\'!</strong><br>'."\n".
				'	<strong>Errorcode</strong>: '.mysql_errno().'<br>'."\n".
				'	<strong>Error</strong>: '.mysql_error().'<br>'."\n".
				'	<strong>Site</strong>: '.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ?
												htmlentities($_SERVER['REQUEST_URI']) : '-').'<br>'."\n".
				'	<strong>Referrer</strong>: '.(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ?
													htmlentities($_SERVER['HTTP_REFERER']) : '-'));
		}
		return true;
	}
	
	private static function SelectDB() {
		$Select = @mysql_select_db(self::$Database);
		if(!$Select) {
			die('<h2>Fatal Error:</h2>'."\n".
				'	<strong>Can\'t find database \''.self::$Database.'\'!</strong><br>'."\n".
				'	<strong>Errorcode</strong>: '.mysql_errno().'<br>'."\n".
				'	<strong>Error</strong>: '.mysql_error().'<br>'."\n".
				'	<strong>Site</strong>: '.(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ?
												htmlentities($_SERVER['REQUEST_URI']) : '-').'<br>'."\n".
				'	<strong>Referrer</strong>: '.(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ?
													htmlentities($_SERVER['HTTP_REFERER']) : '-'));
		}
		return true;
	}
}
?>