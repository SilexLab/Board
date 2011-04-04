<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

class mysqlQuery {
	protected $sql = '';
	protected $errno = 0;
	protected $error = '';
	protected $result;

	public function sql($sql) {
		$this->sql = $sql;
		$this->ExecuteQuery();
	}
	protected function executeQuery() {
		$this->result = mysql_query($this->sql);
		if(!$this->result) {
			$this->errno = mysql_errno();
			$this->error = mysql_error();
			die($this->getError());
		}
	}
	
	public function GetError() {
		$str  =  "<h2 style=\"display:block;\">Fatal MySQL Error:</h2>\n"
				."	<b>Errorcode</b>: ".$this->errno."<br />\n"
				."	<b>Error</b>: ".$this->error."<br />"
				."	<b>Query</b>:<div style=\"padding:0 0 0 20px;\"><pre>".$this->sql."</pre></div><br />\n"
				."	<b>File</b>: ".__FILE__."<br />\n"
				."	<b>Site</b>: ".(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? htmlentities($_SERVER['REQUEST_URI']) : "-")."<br />\n"
				."	<b>Referrer</b>: ".(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? htmlentities($_SERVER['HTTP_REFERER']) : "-")."<br />\n"
				."</div>\n";
		return $str;
	}
	public function FetchObject() {
		return mysql_fetch_object($this->result);
	}
	public function FetchArray() {
		return mysql_fetch_assoc($this->result);
	}
	public function NumRows() {
		return mysql_num_rows($this->result);
	}
	public function AffectedRows() {
		return mysql_affected_rows($this->resutl);
	}

	public function Update($table, $updates) {
		$update = 'UPDATE '.$table.' SET ';

		foreach($updates as $key => $value) {
			$update .= $key.' = \''.$value.'\', ';
		}
    
		$update = trim($update, ', ');
		
		$update .= ';';

		$this->sql = $update;
		$this->ExecuteQuery();
	}
	public function Select($table, $rows = '*', $where = '', $order = '', $limit = '') {
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

		$this->sql = $query;
		$this->ExecuteQuery();
	}
	public function Delete($table, $where = '') {
		if(empty($where)) {
			$query = 'DELETE '.$table;
		}
		else if(!empty($where)) {
			$query = 'DELETE FROM '.$table.' WHERE '.$where.';';
		}
		else {
			die('Something went wrong :O');
		}

		$this->sql = $query;
		$this->ExecuteQuery();
	}
	public function Insert($table, $inserts) {
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

		$this->sql = $insert;
		$this->ExecuteQuery();
	}
	
	public function free() {
		mysql_free_result($this->result);
	}
}
?>